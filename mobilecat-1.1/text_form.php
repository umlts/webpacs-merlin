<?
    require_once('util.php');

    $sm = get_smarty();

    try {
        $sm->assign("bibid", ar_get('bibid', $_REQUEST));
        $sm->assign("jsfiles", array("static/resizer.js"));
    
        header("Content-Type: text/html; charset=utf-8");
        $sm->display("forms/text_form.html");

    } catch (Exception $e) {
        $sm->assign("error", $e->getMessage());
        $sm->display("responses/error.html");
    }
 
?> 
