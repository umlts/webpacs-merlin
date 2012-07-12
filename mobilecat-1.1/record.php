<?

    require_once("util.php");

    function get_detail_html($record) {
        $sm = get_smarty();

        $sm->assign("r", $record);

        return $sm->fetch("pages/detail.html");
    }

    $p = new SiteParse();

    $bibid = valid_bibid($_REQUEST['bibid']);

    $record = $p->get_record($bibid);
    $record["info_keys"] = $p->detail_keys;
    if(isset($record["is_saved"])) $record["is_saved"] = array_key_exists($bibid, $_SESSION['saved']);

    header("Content-Type: application/javascript; charset=utf-8");

    echo json_encode(array(
        "info"         => $record["info"],
        "locations"    => $record["locations"], 
        "record_html"  => get_detail_html($record),
    ));

?>
