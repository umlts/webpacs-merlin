<?
    require_once("util.php");

    $p = new SiteParse();

    try {
        $bibid = valid_bibid($_REQUEST['bibid']);

        $record = $p->get_record($bibid);
        $record["info_keys"] = $p->detail_keys;
        if ($saved = ar_get('saved', $_SESSION)) {
            $record["is_saved"] = array_key_exists($bibid, $saved);
        }

        $sm = get_smarty();
        $sm->assign("r", $record);
        if(isset($_REQUEST['scope'])) $sm->assign("scope", $_REQUEST['scope']);

        header("Content-Type: text/html; charset=utf-8");
        $sm->display("pages/detail_nojs.html");

    } catch (Exception $e) {
        $sm->assign("error", $e->GetMessage());
        $sm->display("responses/error.html");
    }

?>
