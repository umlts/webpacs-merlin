<?
    require_once("util.php");

    function get_browse_html($results) {
        $sm = get_smarty();

        $sm->assign('results', $results);

        return $sm->fetch('pages/search_results.html');
    }

    function get_one_result_html($record) {
        $p = new SiteParse();
        $sm = get_smarty();

        $record["info_keys"] = $p->detail_keys;
        if ($saved = ar_get('saved', $_SESSION)) {
            $record["is_saved"] = array_key_exists($bibid, $saved);
        }

        $sm->assign("r", $record);
        $html = $sm->fetch("pages/detail_all.html");

        return $html;
    }

    $ret = get_browse_results();

    if ($ret['oneres'] != True) {

        $html = get_browse_html($ret['results']);

        $json_data = array(
            "oneres"  => False,
            "results" => $ret['results'],
            "prev"    => $ret['navlinks']['Prev'],
            "next"    => $ret['navlinks']['Next'],
            "num"     => $ret['num'],

            "results_html" => $html,
        );

    } else {

        $json_data = array(
            "oneres" => True,
            "results_html" => get_one_result_html($ret['record']),
            "num" => 1,
        );
    }

    if (array_key_exists('searcharg', $_REQUEST)) {
        $json_data['searcharg'] = $_REQUEST['searcharg'];
    }

    header("Content-Type: application/javascript; charset=utf-8");
        
    echo json_encode($json_data);
?>
