<?php
session_start();
define('LIBRARIES','./libraries/');
define('SOURCES','./sources/');
define('LAYOUT','layout/');
define('THUMBS','thumbs');
define('WATERMARK','watermark');

/* Config */
require_once LIBRARIES."config.php";
require_once LIBRARIES.'autoload.php';
    // require_once __DIR__.'/addons/vendor/autoload.php';
new AutoLoad();
$injection = new AntiSQLInjection();
$d = new PDODb($config['database']);
$detect = new MobileDetect();
$seo = new Seo($d);
$emailer = new Email($d);
$router = new AltoRouter();
$cache = new FileCache($d);

if(isset($detect)){
    $deviceType = ($detect->isMobile() || $detect->isTablet()) ? 'mobile' : 'computer';
    if($deviceType == 'computer') $func = new Functions($d);
    else $func = new FunctionsMobile($d);
}else{
   $func = new Functions($d);
}

$breadcr = new BreadCrumbs($d);
$statistic = new Statistic($d, $cache);
$cart = new Cart($d);

$addons = new AddonsOnline();
$css = new CssMinify($config['website']['debug-css'], $func);
$js = new JsMinify($config['website']['debug-js'], $func);

$Product =  new Product($d);
    // $Member =  new Member($d);

require_once LIBRARIES."function.php";
/* Router */
require_once LIBRARIES."router.php";
// echo md5('$nina@'.'123456'.'swKJjeS!t');

include TEMPLATE."index.php";

?>