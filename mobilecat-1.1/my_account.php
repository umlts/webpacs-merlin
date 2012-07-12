<?
    require_once("util.php");

    $sm = get_smarty();
    $p = new SiteParse();

    try { 
        if (!ar_get('userid', $_SESSION)) {
            $query = http_build_query(array(
                "redirect" => $p->base_url . "my_account",
            ));
            
            header("Location: " . $p->base_url . "login?" . $query);
            
        } else {
            $url = ar_get('url', $_REQUEST);
            list($items, $holds, $fines) = $p->get_my_account_info($_SESSION['name'], $_SESSION['code'], $_SESSION['userid'], $url);

            header("Content-Type: text/html; charset=utf-8");
            $sm->assign("items", $items);
            $sm->assign("holds", $holds);
            $sm->assign("fines", $fines);
            
            $sm->display("pages/my_account.html");
        }
    } catch (Exception $e) {
        $sm->assign("error", $e->GetMessage());
        $sm->display("responses/error.html");
    }
?>

