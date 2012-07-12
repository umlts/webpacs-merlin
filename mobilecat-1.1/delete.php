<?
    require_once("util.php");

    $sm = get_smarty();

    try {
        $bibid = ar_get('bibid', $_REQUEST);

        if ($bibid == "all") {
            unset($_SESSION['saved']);
            $page = "responses/delete_all.html"; 
        } else {
            $bibid = valid_bibid($bibid);
            $sm->assign("bibid", $bibid);
            unset($_SESSION['saved'][$bibid]);
            $page = "responses/delete_one.html"; 
        }

        header("Content-Type: text/html; charset=utf-8");
        $sm->display($page);

    } catch (Exception $e) {
        $sm->assign("error", $e->GetMessage());
        $sm->display("responses/error.html");
    }
?>
