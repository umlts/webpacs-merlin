<?
    require_once('util.php');

    $sm = get_smarty();
    $p = new SiteParse();

    try {
        if (!ar_get('userid', $_SESSION)) {
            throw new Exception("Please log into your account.");

        } else {
            $post_params = array(
                "locx00" => ar_get("locx00", $_REQUEST),
                "inst"   => ar_get("inst", $_REQUEST),
                "submit" => ar_get("submit", $_REQUEST),
                "submit.x" => ar_get("submit.x", $_REQUEST),
                "submit.y" => ar_get("submit.y", $_REQUEST),
            );
            
            $req_url = ar_get('request_url', $_REQUEST);

            $name = $_SESSION['name'];
            $code = $_SESSION['code'];

            $resp = $p->get_request_loc($name, $code, $req_url, $post_params);

            $sm->assign("locs", $resp["locs"]);
            $sm->assign("hidden", $resp["hidden"]);
            $sm->assign("url", $req_url);
            $sm->assign("bibid", ar_get('bibid', $_REQUEST));

            $sm->display("forms/request_form_step2.html");
        }

    } catch (Exception $e) {
        $sm->assign("error", $e->GetMessage());
        $sm->display("responses/error.html");
    }
?> 
