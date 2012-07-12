<?
    require_once("util.php");

    function get_detail_text($record, $is_text) {
        
        $sm = get_smarty();

        $sm->assign("is_text", $is_text);
        $sm->assign("r", $record);

        return $sm->fetch("email/send_message.txt");
    }

    function get_email_addr() {

        if (array_key_exists('text', $_REQUEST) and
            array_key_exists('domain', $_REQUEST)) {
            $is_text = true;

            $text   = valid_phone($_REQUEST['text']);
            $domain = $_REQUEST['domain']; 

            $email = valid_email(sprintf("%s@%s", $text, $domain));

            # Save for next time
            $_SESSION['text'] = $text;
            $_SESSION['domain'] = $domain;

        } else if (array_key_exists('email', $_REQUEST)) {
            $is_text = false;
            
            $email = valid_email($_REQUEST['email']);
            
            # Save for next time
            $_SESSION['email'] = $email;

        } else {
            throw new Exception("No destination information provided.");
        }

        return array($email, $is_text);
    }

    function get_email_headers($p) {
        $headers = array();

        $headers[] = "Content-Type: text/plain; charset=utf-8";

        if ($p->email_from) {
            $headers[] = sprintf("From: %s", $p->email_from);
        }

        return implode("\n", $headers);
    }

    function get_subject($p, $is_text, $record) {
        if (!$is_text) {
            return sprintf("%s: %s", $p->email_subject_prefix, 
                substr($record['info']['Title'], 0, 50));
        }
    }

    function html_entity_decode_ref(&$str) {
        $str = html_entity_decode($str);
    }

    try {
        $p = new SiteParse();
        # Don't set a max value when doing the email, as we don't need to worry
        # about the display
        $p->max_value_length = null;

        list($email, $is_text) = get_email_addr();
        $bibid = valid_bibid($_REQUEST['bibid']);

        $record = $p->get_record($bibid);
        array_walk_recursive($record, "html_entity_decode_ref");
        
        $record["info_keys"] = $p->email_detail_keys;

        $contents = get_detail_text($record, $is_text);

        $headers = get_email_headers($p);
        $subject = get_subject($p, $is_text, $record);

        mail($email, $subject, $contents, $headers);

        $sm = get_smarty();
        $sm->assign("bibid", $bibid);

        if ($is_text) {
            $sm->display("responses/text_success.html");
        } else {
            $sm->display("responses/email_success.html");
        }

    } catch (Exception $e) {
        $sm = get_smarty();
        $sm->assign("error", $e->getMessage());
        
        $sm->display("responses/error.html");
    }
        
    
?>
