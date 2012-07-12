<?
    require_once("util.php");

    $p = new SiteParse();

    try {
        do_logout();
        header("Location: " . $p->base_url);
    
    } catch (Exception $e) {
        $sm->assign("error", $e->GetMessage());
        $sm->display("responses/error.html");
    }
?>
