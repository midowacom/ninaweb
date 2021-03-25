<?php
	session_start();
	define('LIBRARIES','../libraries/');
    define('THUMBS','thumbs');
    define('WATERMARK','watermark');

	if(empty($_SESSION['lang'])) $_SESSION['lang'] = 'vi';
    $lang = $_SESSION['lang'];

    require_once LIBRARIES."config.php";
    require_once LIBRARIES.'autoload.php';
    new AutoLoad();
    $d = new PDODb($config['database']);
    $func = new Functions($d);
    $cache = new FileCache($d);
    $cart = new Cart($d);
    $member = new Member($d);
    $product = new Product($d);
    $detect = new MobileDetect();

    require_once LIBRARIES."lang/lang$lang.php";

    /* Slug lang */
    $sluglang = 'tenkhongdauvi';
?>