<? 
    require_once("util.php");
    
    $sm = get_smarty(); 
   
    try {
        $sm->assign("jsfiles", array("static/search.js"));
        $sm->assign("searcharg", $_REQUEST['searcharg']);
        if(isset($_REQUEST['scope'])) $sm->assign("scope", $_REQUEST['scope']);

        if (blank_search()) {
            $sm->assign("blanksearch", true);
        }

        header("Content-Type: text/html; charset=utf-8");
        $sm->display('pages/search_main.html');

    } catch (Exception $e) {
        $sm->assign("error", $e->GetMessage());
        $sm->display("responses/error.html");
    }
?>
