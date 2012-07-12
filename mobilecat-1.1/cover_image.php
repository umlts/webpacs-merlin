<?
    require_once('SiteParse.php');
    $settings = new SiteParse();

    $isbn = $_REQUEST['isbn'];

    $url = null;

    # Make it save it for a year
    header("Cache-Control: max-age=31536000, public");
    
    try {
        if ($settings->cover_image_type == "syndetics") {
            $client = $settings->cover_userid;
            $url = "http://www.syndetics.com/index.php?isbn=$isbn/sc.gif&client=$client";
        } elseif ($settings->cover_image_type == "openlibrary") {
            $url = "http://covers.openlibrary.org/b/isbn/$isbn-M.jpg";  #api documentation is wrong; this returns a redirect that must be parsed
            //$resp = http_parse_message(http_get($url));
            //$url = $resp->headers['Location'];
        } elseif ($settings->cover_image_type == "contentcafe") {
            $user = $settings->cover_userid;
            $pass =  $settings->cover_pass;
            $url = "http://images.btol.com/ContentCafe/Jacket.aspx?UserID=$user&Password=$pass&Return=1&Type=S&Value=$isbn&erroroverride=1&";
        } elseif ($settings->cover_image_type == "googlebooks") {	
	        $url = "http://books.google.com/books?jscmd=viewapi&bibkeys=$isbn&callback=ProcessGBSBookInfo"; 
	        $resp = http_parse_message(http_get($url));
	   
	        #ugly regex business to strip the callback and its parens; i can do better
	        $matches = preg_split('/\(/', $resp->body);
            $matches = preg_split('/\)/', $matches[1]);	

            #decode json response and assign the image url
    	    $results = json_decode($matches[0], true);
	        $details = $results[$isbn];
	        $url = $details['thumbnail_url'];
	    }
	
        if ($url) {
            $resp = http_parse_message(http_get($url));
            if($resp->headers['Content-Length'] < 1000) throw new Exception("Empty response.");

            header(sprintf("Content-Type: %s", $resp->headers['Content-Type']));
	        $matches = preg_split('/(\<!DOCTYPE|\<html)/', $resp->body);	#strip excess html returned in the body of the request (contentcafe)
	        echo $matches[0];
        } else {
            throw new Exception("No image available.");
        }

    // For any exception, return a blank image
    } catch (Exception $e) {
	    header("Content-Type: image/jpeg");
        echo file_get_contents("static/nocover.jpg");
    }
?>
