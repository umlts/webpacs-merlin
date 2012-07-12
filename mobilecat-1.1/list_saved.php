<?
    require_once("util.php");

    # don't want nojs return-to-search navigation in saved list items.
    clear_prev_search();

    $sm = get_smarty();
    $p = new SiteParse();
   
    try {
        $saved = ar_get('saved', $_SESSION);

        $records = array();
    
        if(!isset($_COOKIE['PHPSESSID'])) $sm->assign('cookies_disabled', true);

        if ($saved) {
            foreach (array_keys($saved) as $pos_bibid) {
                $bibid = valid_bibid($pos_bibid);

                $record  = $p->get_record($bibid);
                $record['info_keys'] = $p->detail_keys;
                $record['is_saved']  = true;

                $records[] = $record;
            }
        }

        $sm->assign("records", $records);
        
        header("Content-Type: text/html; charset=utf-8");
        $sm->display("pages/saved_list.html");

    } catch (Exception $e) {
        $sm->assign("error", $e->GetMessage());
        $sm->display("responses/error.html");
    }

?>
