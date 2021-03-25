<?php
	if(!defined('LIBRARIES')) die("Error");
	
	/* Root */
	define('ROOT',__DIR__);

	/* Timezone */
	date_default_timezone_set('Asia/Ho_Chi_Minh');

	/* Cấu hình coder */
	define('NN_MSHD','99121w');
	define('NN_AUTHOR','vohoangtu.nina@gmail.com');

	/* Cấu hình chung */
	$config = array(
		'author' => array(
			'name' => 'Võ Hoàng Tú',
			'email' => 'vohoangtu.nina@gmail.com',
			'timefinish' => '02/2021'
		),
		'arrayDomainSSL' => array(),
		'database' => array(
			'server-name' => $_SERVER["SERVER_NAME"],
			'url' => '/',
			'type' => 'mysql',
			'host' => 'localhost',
			'username' => 'root',
			'password' => '',
			'dbname' => 'ninaweb',
			'port' => 3306,
			'prefix' => 'table_',
			'charset' => 'utf8'
		),
		'website' => array(
			'error-reporting' => true,
			'secret' => '$nina@',
			'salt' => 'swKJjeS!t',
			'debug-developer' => true,
			'debug-css' => true,
			'debug-js' => false,
			'index' => false,
			'upload' => array(
				'max-width' => 1600,
				'max-height' => 1600
			),
			'lang' => array(
				// 'vi'=>'Tiếng Việt',
				'en'=>'Tiếng Anh'
			),
			'lang-doc' => 'en',
			// 'lang-doc' => 'vi',
			'slug' => array(
				// 'vi'=>'Tiếng Việt',
				'en'=>'Tiếng Anh'
			),
			'seo' => array(
				// 'vi'=>'Tiếng Việt',
				'en'=>'Tiếng Anh'
			),
			'comlang' => array(
				// "gioi-thieu" => array("vi"=>"gioi-thieu","en"=>"about-us"),
				// "san-pham" => array("vi"=>"san-pham","en"=>"product"),
				// "tin-tuc" => array("vi"=>"tin-tuc","en"=>"news"),
				// "tuyen-dung" => array("vi"=>"tuyen-dung","en"=>"recruitment"),
				// "thu-vien-anh" => array("vi"=>"thu-vien-anh","en"=>"gallery"),
				// "video" => array("vi"=>"video","en"=>"video"),
				// "lien-he" => array("vi"=>"lien-he","en"=>"contact")
			)
		),
		'product' => array(
			
		),
		'cart' => array(
			'active' => false
		),
		'order' => array(
			'active' => false,
			'ship' => false,
			'excel' => false,
			'word' => false,
			'excelall' => false,
			'wordall' => false,
			'thumb' => '120x120',

		),
		'permission' => false,
		'user' =>array(
			'active' => true,
			'admin' => true,
			'visitor' => false,
			'visitor_group' => false,

		),
		'login' => array(
			'admin' => 'LoginAdmin'.NN_MSHD,
			'member' => 'LoginMember'.NN_MSHD,
			'attempt' => 5,
			'delay' => 15
		),
		'googleAPI' => array(
			'recaptcha' => array(
				'active' => false,
				'urlapi' => 'https://www.google.com/recaptcha/api/siteverify',
				'sitekey' => '6Lct3z0aAAAAALKgRhFuDC_eUVXJ1Glrrs29UwiC',
				'secretkey' => '6Lct3z0aAAAAAOhtG_eTTRqZiccDyupJgp-K4S2Z'
			)
		),
		'oneSignal' => array(
			'active' => false,
			'id' => 'af12ae0e-cfb7-41d0-91d8-8997fca889f8',
			'restId' => 'MWFmZGVhMzYtY2U0Zi00MjA0LTg0ODEtZWFkZTZlNmM1MDg4'
		),
		'license' => array(
			'version' => "7.0.0",
			'powered' => "phuctai.nina@gmail.com"
		)
	);

	/* Error reporting */
	ini_set('display_errors', 1); ini_set('display_startup_errors', 1);

	error_reporting(($config['website']['error-reporting']) ? E_ALL : 0);

	/* Cấu hình base */
	$http = 'http://';
	if($config['arrayDomainSSL']){
		require_once LIBRARIES."checkSSL.php";
		$http = $Protocol;
	}
	$config_url = $config['database']['server-name'].$config['database']['url'];
	$config_base = $http.$config_url;

	/* Cấu hình login */
	$login_admin = $config['login']['admin'];
	$login_member = $config['login']['member'];

	/* Cấu hình upload */
	require_once LIBRARIES."constant.php";
?>