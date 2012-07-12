<?
    require_once('util.php');

    $sm = get_smarty();
    $p = new SiteParse();

    try {
        if (!ar_get('userid', $_SESSION)) {
            throw new Exception("Please log into your account.");

        } else {
            $sm->assign("bibid", ar_get('bibid', $_REQUEST));
            $name = $_SESSION['name'];
            $code = $_SESSION['code'];

            $url = ar_get('request_url', $_REQUEST);

            $post_params = array();
            foreach (array('radio', 'locx00', 'inst', 'submit', 'submit.x', 'submit.y', 'name', 'code') as $key) {
                $post_params[$key] = ar_get($key, $_REQUEST);
            }

            if ($p->submit_item_request($name, $code, $url, $post_params)) {
                $sm->display("responses/request_success.html");
            }
        }

    } catch (Exception $e) {
        $sm->assign("error", $e->GetMessage());
        $sm->display("responses/error.html");
    }
        
?> 
