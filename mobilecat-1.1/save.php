<?
    require_once("util.php");

    $sm = get_smarty();

    try {
        if(isset($_SESSION['saved'])) {
            if (count($_SESSION['saved']) >= 15) {
                throw new Exception("Too many items on the saved list.");
            }
        }
    

        $bibid = valid_bibid($_REQUEST['bibid']);

        $_SESSION['saved'][$bibid] = true;

        $sm->assign("bibid", $bibid);

        header("Content-Type: text/html; charset=utf-8");
        $sm->display("responses/saved_one.html");


    } catch (Exception $e) {
        $sm->assign("error", $e->GetMessage());
        $sm->display("responses/error.html");
    }
?>
