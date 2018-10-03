<?session_start();

define('ROOT',$_SERVER['DOCUMENT_ROOT']);
define('header',ROOT."/views/templates/header.php");
define('slider',ROOT."/views/templates/slider.php");
define('head',ROOT."/views/templates/head.php");
define('ahead',ROOT."/views/templates/ahead.php");
define('sidebar',ROOT."/views/templates/sidebar.php");
define('rightbar',ROOT."/views/templates/rightbar.php");
define('asidebar',ROOT."/views/templates/asidebar.php");
define('arightbar',ROOT."/views/templates/arightbar.php");
define('require_foot',ROOT."/views/templates/require_foot.php");
define('footer',ROOT."/views/templates/footer.php");
define('img',"/public/img");
define('files',"/readbook-");

require_once(ROOT . "/public/libs/rb.php");
require_once (ROOT."/core/config/config.php");
require_once(ROOT . "/core/config/private.php");
require_once(ROOT . '/core/models/AdminModel.php');
require_once(ROOT . '/core/models/AuthModel.php');
require_once(ROOT . '/core/controllers/AJAXController.php');
require_once(ROOT . '/core/models/ContentModel.php');
require_once(ROOT . '/core/models/PagginateModel.php');
require_once(ROOT . '/core/controllers/AuthController.php');
require_once(ROOT . '/core/controllers/UserController.php');
require_once(ROOT . '/core/controllers/PaginateController.php');


/*error_reporting(E_ALL);
ini_set('display_errors', 1);*/

define('pathindex', "/");
define('pathadmin', "/admin/");
define('pathregistration', "/admin/registration/");
define('pathedituser', "/admin/editusers/");
define('pathaddstud', '/admin/addnewstud/');
define('pathaddwork', '/admin/addworkbook/');
define('patheditwork', '/admin/editworkbook/');
define('pathreport', '/admin/report/');
define('pathcategory', "/category/");
define('pathsearch', "/search/");
define('pathdetails', "/details/");
define('pathabout', "/about/");
define('pathupload', "/upload/");
define('libraryname','School-Library');
define('organisation',' МКОУ Губаревская СОШ');


?>
