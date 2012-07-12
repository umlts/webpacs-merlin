<?
    require_once('util.php');

    $sm = get_smarty();
    $p = new SiteParse();

    try {
        if (!ar_get('userid', $_SESSION)) {

            $query = http_build_query(array(
                "redirect" => $_SERVER['REQUEST_URI']
            ));

            $page = use_js() ? "small_login" : "login";

            header("Location: " . $p->base_url . "$page?" . $query);

        } else {

            $bib  = ar_get('bibid', $_REQUEST);
            $rurl = ar_get('url', $_REQUEST);
       
            $loc_options = $p->get_request_form($_SESSION['name'], $_SESSION['code'], $rurl);

            # if only one request location, skip step1?
            if(!$loc_options) $loc_options = array("Library pickup?");

            $sm->assign("jsfiles", array("static/relogin.js"));
            $sm->assign("bibid", $bib);
            $sm->assign("url", $rurl);

            $sm->assign("loc_options", $loc_options);
            $sm->display("forms/request_form_step1.html");

        }
    } catch (Exception $e) {
        $sm->assign("error", $e->GetMessage());
        $sm->display("responses/error.html");
    }
        
?> 
