<?php
	session_start();
	define('LIBRARIES','../../libraries/');
    define('THUMBS','thumbs');
    define('WATERMARK','watermark');

	if(!isset($_SESSION['lang'])) $_SESSION['lang'] = 'vi';
    $lang = $_SESSION['lang'];

    require_once LIBRARIES."config.php";
    require_once LIBRARIES.'autoload.php';
    new AutoLoad();
    $d = new PDODb($config['database']);
    $func = new Functions($d);
    $cache = new FileCache($d);
    $cart = new Cart($d);
    require_once LIBRARIES."lang/lang$lang.php";

    /* Slug lang */
    $sluglang = 'tenkhongdauvi';


$base64_str = substr($_POST['base64_image'], strpos($_POST['base64_image'], ",")+1);
//decode base64 string
$name = "product-".strtotime('now').".png";
$decoded = base64_decode($base64_str);
$png_url = $_SERVER['DOCUMENT_ROOT']."upload/customer/".$name;
//create png from decoded base 64 string and save the image in the parent folder
$result = file_put_contents($png_url, $decoded);

//send result - the url of the png or 0
header('Content-Type: application/json');
if($result) {
	$png_url = $config_base.'upload/customer/'.$name;
	$apag['png_url'] = $png_url;
	echo json_encode($apag);
}
else {
	echo json_encode(0);
}

//returns the current folder URL
function get_folder_url() {
	$url = $_SERVER['REQUEST_URI']; //returns the current URL
	$parts = explode('/',$url);
	$dir = $_SERVER['SERVER_NAME'];
	for ($i = 0; $i < count($parts) - 1; $i++) {
		$dir .= $parts[$i] . "/";
	}
	return 'http://'.$dir;
}

?>