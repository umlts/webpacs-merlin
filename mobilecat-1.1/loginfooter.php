<?
    require_once("util.php");

    $sm = get_smarty();

    try {
        header("Content-Type: text/html; charset=utf-8");
        $sm->display("include/loginfooter.html");

    } catch (Exception $e) {
        $sm->assign("error", $e->GetMessage());
        $sm->display("responses/error.html");
    }
?>
