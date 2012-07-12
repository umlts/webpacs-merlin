<?
    require_once("util.php");

    try {
        $p = new SiteParse();

        $email = valid_email($_REQUEST['email']);
        $_SESSION['email'] = $email;
        
        $headers[] = "Content-Type: text/plain; charset=utf-8";
        $headers[] = sprintf("From: %s", $email);
        $headers_str = implode("\n", $headers);

        $contents = implode("\n\n", array(
            ar_get('device', $_REQUEST),
            ar_get('browser', $_REQUEST),
            ar_get('HTTP_USER_AGENT', $_SERVER),
            ar_get('feedback', $_REQUEST),
        ));

        $subject = "[TripodMobile] Feedback";
        mail($p->feedback_email, $subject, $contents, $headers_str);

        $sm = get_smarty();

        $sm->display("responses/feedback_success.html");

    } catch (Exception $e) {
        $sm = get_smarty();
        $sm->assign("error", $e->getMessage());
        
        $sm->display("responses/error.html");
    }
        
    
?>
