<? 


    require_once("util.php");
    $sm = get_smarty();

    try {
        $ret = get_browse_results();

        if ($ret['oneres'] != True) {
            $sm->assign("searcharg", $_REQUEST['searcharg']);
            if(isset($_REQUEST['scope'])) $sm->assign("scope", $_REQUEST['scope']);
            $sm->assign("prev", $ret['navlinks']['Prev']);
            $sm->assign("next", $ret['navlinks']['Next']);
            $sm->assign("num", $ret['num']);
            $sm->assign("results", $ret['results']);

            # for nojs return-to-search navigation
            $_SESSION['searcharg'] = $_REQUEST['searcharg'];
            if(array_key_exists('url', $_REQUEST)) {
                $results_url = urlencode($_REQUEST['url']);
                $_SESSION['results_url'] = $results_url;
            } else {
                unset($_SESSION['results_url']);
            }

            if (blank_search()) {
                $sm->assign("blanksearch", true);
            }

            header("Content-Type: text/html; charset=utf-8");
            $sm->display('pages/search_nojs_main.html');
        } else {
            clear_prev_search();

            # present single record
            $record = $ret['record'];

            $p = new SiteParse();
            $record["info_keys"] = $p->detail_keys;
            if ($saved = ar_get('saved', $_SESSION)) {
                $record["is_saved"] = array_key_exists($bibid, $saved);
            }

            $sm = get_smarty();
            $sm->assign("r", $record);

            header("Content-Type: text/html; charset=utf-8");
            $sm->display("pages/detail_nojs.html");
        }
    } catch (Exception $e) {
        $sm->assign("error", $e->GetMessage());
        $sm->display("responses/error.html");
    }

?>
