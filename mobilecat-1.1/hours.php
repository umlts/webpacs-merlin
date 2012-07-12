<? 
    require_once("util.php");
    require_once("TricoHours.php");

    $sm = get_smarty();

    try {
        header("Content-Type: text/html; charset=utf-8");
        
        $delta = ar_get('delta', $_REQUEST);
        if (!$delta) { 
            $delta = 0;
        }

        $hours = new TricoHours($delta);
        $hours->run();

        $date   = $hours->get_date();
        $events = $hours->get_events();

        $sm->assign("date", $date);
        $sm->assign("events", $events);
        $sm->assign("delta", $delta);

        $sm->display('pages/hours.html');

    } catch (Exception $e) {
        $sm->assign("error", $e->GetMessage());
        $sm->display("responses/error.html");
    }

?>
