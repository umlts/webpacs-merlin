<?
    require_once("util.php");

    $sm = get_smarty();
    $p = new SiteParse();

    try {
        if ($redirect = ar_get('redirect', $_REQUEST)) {
            $sm->assign("redirect", $redirect);
        } else {
            $sm->assign("redirect", $p->base_url);
        }

        if ($error = ar_get('error', $_REQUEST)) {
            $sm->assign("error", true);
        }

        header("Content-Type: text/html; charset=utf-8");
        $sm->display("forms/small_login.html");

    } catch (Exception $e) {
        $sm->assign("error", $e->GetMessage());
        $sm->display("responses/error.html");
    }
?>
