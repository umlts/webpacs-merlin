<?
    require_once('util.php');

    $sm = get_smarty();

    try {
        $sm->assign("bibid", ar_get('bibid', $_REQUEST));
        header("Content-Type: text/html; charset=utf-8");
        $sm->display("forms/email_form.html");

    } catch (Exception $e) {
        $sm->assign("error", $e->GetMessage());
        $sm->display("responses/error.html");
    }



?> 
