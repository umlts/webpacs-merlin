<?

require_once('SiteParse.php');
require_once('Smarty/Smarty.class.php');

error_reporting(E_ERROR);

function ar_get($key, $array) {
    if (array_key_exists($key, $array)) {
        return $array[$key];
    } else {
        return null;
    }
}

function get_smarty() {
    $smarty = new Smarty();

    $p = new SiteParse();

    # Basic info we need in templatse
    $smarty->assign("baseurl", $p->base_url);
    $smarty->assign("catalogname", $p->catalog_name);
    $smarty->assign("catalogurl", $p->catalog_url);
    $smarty->assign("feedback_email", $p->feedback_email);
    $smarty->assign("scoping", $p->scoping);
    $smarty->assign("scopes", $p->scopes);
    $smarty->assign("def_scope", $p->def_scope);

    # Last email address used to send a record
    $smarty->assign('saved_email',  ar_get('email', $_SESSION));

    # Last text message info used to send a record
    $smarty->assign('saved_text',   ar_get('text', $_SESSION));
    $smarty->assign('saved_domain', ar_get('domain', $_SESSION));
    
    # User login info
    $smarty->assign('saved_name', ar_get('name', $_SESSION));
    $smarty->assign('saved_code', ar_get('code', $_SESSION));
    $smarty->assign('saved_userid', ar_get('userid', $_SESSION));

    $smarty->assign('js', use_js());

    # How many records have we saved on our device list?
    if (($saved = ar_get('saved', $_SESSION))) {
        $smarty->assign('saved_count',  count($saved));
    } else {
        $smarty->assign('saved_count', 0);
    }

    $smarty->assign("mobile_domains", $p->mobile_domains);

    # for nojs return-to-search navigation
    $smarty->assign('search_arg', ar_get('searcharg', $_SESSION));
    $smarty->assign('last_results', ar_get('results_url', $_SESSION));

    return $smarty;
}

function valid_bibid($pos_bibid) {
    if (preg_match('/^b\d+$/', $pos_bibid, $matches) > 0) {
        return $matches[0];
    } else {
        throw new Exception("Invalid bibid");
    }
}

/*
    filter_var only exists in PHP >= 5.2
function valid_email($pos_email) {
    if (($email = filter_var($pos_email, FILTER_VALIDATE_EMAIL))) {
        return $email;
    } else {
        throw new Exception("Invalid destination address");
    }
}
*/

// Silly regex for an email address, not perfect
function valid_email($pos_email) {
    if (preg_match('/[0-9A-z\.\_\-\@]/', $pos_email)) {
        return $pos_email;
    } else {
        throw new Exception("Invalid destination address.");
    }
}

// requires at least 10 digits; filters non-digits.
function valid_phone($pos_phone) {
    $clean_phone = (preg_replace('/\D*/', '', $pos_phone));
    if (strlen($clean_phone) > 9) {  
        return $clean_phone;
    } else {
        throw new Exception("Phone number too short.");
    }
}

function get_browse_results() {
    $p = new SiteParse();
     
    # The "More..." link presents a specific url to request, with 
    # session info and other stuff
    if (array_key_exists('url', $_REQUEST)) {
        return $p->get_next_browse($_REQUEST['url']);
    
    # For a normal search link, just use the search arg
    } else {
        if(isset($_REQUEST['scope'])) return $p->get_browse($_REQUEST['searcharg'], $_REQUEST['scope']);
        else return $p->get_browse($_REQUEST['searcharg']);
    }
}

function do_logout() {
    unset($_SESSION['name']);
    unset($_SESSION['code']);
    unset($_SESSION['userid']);
}

function clear_prev_search() {
    # for nojs return-to-search navigation
    unset($_SESSION['searcharg'], $_SESSION['results_url']);
}

function blank_search() {
    $searcharg = ar_get('searcharg', $_REQUEST);

    if (!$searcharg || preg_match('/^\s*$/', $searcharg)) {
        return true;
    } else {
        return false;
    }
}

$USE_JS;
function use_js() {
    global $USE_JS;

    if (isset($USE_JS)) {
        return $USE_JS;

    } else {
        
        if (isset($_REQUEST['forcejs'])) {
            $_SESSION['forcejs'] = $_REQUEST['forcejs'];
        }
        
        $user = $_SERVER['HTTP_USER_AGENT'];

        if (isset($_SESSION['forcejs']) and ($_SESSION['forcejs'] == 1)) {
            $USE_JS = true;
        } else if (isset($_SESSION['forcejs']) and ($_SESSION['forcejs'] == 0)) {
            $USE_JS = false;
        } else if (preg_match('/AppleWebKit/', $user)) {    # safari and chrome
            $USE_JS = true;
        } else if (preg_match('/Gecko/', $user)) {  # firefox
            $USE_JS = true;
        } else if (preg_match('/webOS/', $user)) {  # palm webos
            $USE_JS = true;
        } else {
            $USE_JS = false;
        }
        
    }

    return $USE_JS;
}

session_cache_limiter("nocache");
session_set_cookie_params(2592000);
session_start();

?>
