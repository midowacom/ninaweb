<?php
/* Check HTTP */
$func->checkHTTP($http,$config['arrayDomainSSL'],$config_base,$config_url);

/* Validate URL */
$func->checkUrl($config['website']['index']);

/* Check login */
$func->checkLogin();

/* Mobile detect */

define('TEMPLATE','./templates/');

/* Watermark */
$wtmPro = $d->rawQueryOne("select hienthi, photo, options from #_photo where type = ? and act = ? limit 0,1",array('watermark','photo_static'));
$wtmNews = $d->rawQueryOne("select hienthi, photo, options from #_photo where type = ? and act = ? limit 0,1",array('watermark-news','photo_static'));

/* Router */
$router->setBasePath($config['database']['url']);
$router->map('GET',array('admin/','admin'), function(){
	global $func, $config;
	$func->redirect($config['database']['url']."admin/index.php");
	exit;
});
$router->map('GET',array('admin','admin'), function(){
	global $func, $config;
	$func->redirect($config['database']['url']."admin/index.php");
	exit;
});
$router->map('GET|POST', '', 'index', 'home');
$router->map('GET|POST', 'index.php', 'index', 'index');
$router->map('GET|POST', 'sitemap.xml', 'sitemap', 'sitemap');
$router->map('GET|POST', '[a:com]', 'allpage', 'show');
$router->map('GET|POST', '[a:com]/[a:lang]/', 'allpagelang', 'lang');
$router->map('GET|POST', '[a:com]/[a:action]', 'account', 'account');
$router->map('GET|POST', 'account/[a:action]/[**:query]', 'account', 'account-query');

$router->map('GET', THUMBS.'/[i:w]x[i:h]x[i:z]/[**:src]', function($w,$h,$z,$src){
	global $func;
	$func->createThumb($w,$h,$z,$src,null,THUMBS);
},'thumb');
$router->map('GET', WATERMARK.'/product/[i:w]x[i:h]x[i:z]/[**:src]', function($w,$h,$z,$src){
	global $func, $wtmPro;
	$func->createThumb($w,$h,$z,$src,$wtmPro,"product");
},'watermark');
$router->map('GET', WATERMARK.'/news/[i:w]x[i:h]x[i:z]/[**:src]', function($w,$h,$z,$src){
	global $func, $wtmNews;
	$func->createThumb($w,$h,$z,$src,$wtmNews,"news");
},'watermarkNews');
$match = $router->match();
if(is_array($match))
{
	if(is_callable($match['target']))
	{
		call_user_func_array($match['target'], $match['params']); 
	}
	else
	{
		$com = (isset($match['params']['com'])) ? htmlspecialchars($match['params']['com']) : htmlspecialchars($match['target']);
		$get_page = isset($_GET['p']) ? htmlspecialchars($_GET['p']) : 1;
	}
}
else
{
	header('HTTP/1.0 404 Not Found', true, 404);
	include("404.php");
	exit;
}

/* Setting */
$sqlCache = "select * from #_setting";
$setting = $cache->getCache($sqlCache,'fetch',7200);
$optsetting = (isset($setting['options']) && $setting['options'] != '') ? json_decode($setting['options'],true) : null;

/* Lang */
if(isset($match['params']['lang']) && $match['params']['lang'] != '') $_SESSION['lang'] = $match['params']['lang'];
else if(!isset($_SESSION['lang']) && !isset($match['params']['lang'])) $_SESSION['lang'] = $optsetting['lang_default'];
$lang = $_SESSION['lang'];

$func->checkLang($lang,'vi');
/* Slug lang */
$sluglang = 'tenkhongdau'.$lang;

/* SEO Lang */
$seolang = $lang;

/* Require datas */
require_once LIBRARIES."lang/lang$lang.php";
require_once SOURCES."allpage.php";

/* Tối ưu link */
$requick = array(
	array("tbl"=>"product_cat","field"=>"idc","source"=>"product","com"=>"product","type"=>"san-pham"),
	array("tbl"=>"product_list","field"=>"idl","source"=>"product","com"=>"product","type"=>"san-pham"),
	array("tbl"=>"product","field"=>"id","source"=>"product","com"=>"product","type"=>"san-pham",'menu'=>true),

	array("tbl"=>"product","field"=>"id","source"=>"product","com"=>"gallery","type"=>"gallery",'menu'=>true),

	
);

$tenkhongdau = "";

/* Find data */
if(!in_array($com,array('tim-kiem','account','sitemap','newsletter')))
{
	foreach($requick as $k => $v)
	{
		$url_tbl = (isset($v['tbl']) && $v['tbl'] != '') ? $v['tbl'] : '';
		$url_tbltag = (isset($v['tbltag']) && $v['tbltag'] != '') ? $v['tbltag'] : '';
		$url_type = (isset($v['type']) && $v['type'] != '') ? $v['type'] : '';
		$url_field = (isset($v['field']) && $v['field'] != '') ? $v['field'] : '';
		$url_com = (isset($v['com']) && $v['com'] != '') ? $v['com'] : '';

		if($url_tbl!='' && $url_tbl!='static' && $url_tbl!='photo')
		{
			$row = $d->rawQueryOne("select id,$sluglang from #_$url_tbl where $sluglang = ? and type = ? and hienthi > 0 limit 0,1",array($com,$url_type));

			if(isset($row['id']) && $row['id'] > 0)
			{
				$_GET[$url_field] = $row['id'];
				$com = $url_com;
				$tenkhongdau = $row[$sluglang];
				break;
			}
		}
	}
}
/* Switch coms */
switch($com)
{
	case 'newsletter':
	$source = "newsletter";
	break;
	case 'save-thietke':
	$source = "save-thietke";
	break;
	case 'thiet-ke':
	$source = "thietkeao_list";
	$template = "thietkeao/index";
	$title_crumb = thietkeao;
	break;
	case 'about-us':
	$source = "static";
	$template = "static/static";
	$type = $com;
	$seo->setSeo('type','article');
	
	$title_crumb = "About Us";
	break;

	case 'contact':
	$source = "contact";
	$template = "contact/contact";
	$seo->setSeo('type','object');
	$title_crumb = "Contact";
	break;

	case 'tin-tuc':
	$source = "news";
	$template = isset($_GET['id']) ? "news/news_detail" : "news/news";
	$seo->setSeo('type',isset($_GET['id']) ? "article" : "object");
	$type = $com;
	$title_crumb = tintuc;
	break;
	case 'tieu-chi':
	$source = "news";
	$template = isset($_GET['id']) ? "news/news_detail" : "news/news";
	$seo->setSeo('type',isset($_GET['id']) ? "article" : "object");
	$type = $com;
	$title_crumb = "Tiêu chí";
	break;
	case 'cong-trinh':
	$source = "news";
	$template = isset($_GET['id']) ? "news/news_detail" : "news/news";
	$seo->setSeo('type',isset($_GET['id']) ? "article" : "object");
	$type = $com;
	$title_crumb = "Công Trình";
	break;

	case 'dich-vu':
	$source = "news";
	$template = isset($_GET['id']) ? "news/news_detail" : "news/news";
	$seo->setSeo('type',isset($_GET['id']) ? "article" : "object");
	$type = $com;
	$title_crumb = dichvu;
	break;

	case 'khu-vuc':
	$source = "news";
	$template = isset($_GET['id']) ? "news/news_detail" : "news/news";
	$seo->setSeo('type',isset($_GET['id']) ? "article" : "object");
	$type = $com;
	$title_crumb = "Khu vực thu mua";
	break;

	case 'thu-mua':
	$source = "news";
	$template = isset($_GET['id']) ? "news/news_detail" : "news/news";
	$seo->setSeo('type',isset($_GET['id']) ? "article" : "object");
	$type = $com;
	$title_crumb = "Thu mua phế liệu";
	break;

	case 'bang-gia':
	$source = "news";
	$template = isset($_GET['id']) ? "news/news_detail" : "news/news";
	$seo->setSeo('type',isset($_GET['id']) ? "article" : "object");
	$type = $com;
	$title_crumb = banggia;
	break;

	case 'ho-tro':
	$source = "news";
	$template = isset($_GET['id']) ? "news/news_detail" : "news/news";
	$seo->setSeo('type',isset($_GET['id']) ? "article" : "object");
	$type = $com;
	$title_crumb = "Hỗ Trợ Kỹ Thuật";
	break;


	case 'su-kien':
	$source = "news";
	$template = isset($_GET['id']) ? "news/news_detail" : "news/news";
	$seo->setSeo('type',isset($_GET['id']) ? "article" : "object");
	$type = $com;
	$title_crumb = sukien;
	break;

	case 'tuyen-dung':
	$source = "news";
	$template = isset($_GET['id']) ? "news/news_detail" : "news/news";
	$seo->setSeo('type',isset($_GET['id']) ? "article" : "object");
	$type = $com;
	$title_crumb = tuyendung;
	break;

	case 'chinh-sach':
	$source = "news";
	$template = isset($_GET['id']) ? "news/news_detail" : "news/news";
	$seo->setSeo('type','article');
	$type = $com;
	$title_crumb = "Chính Sách";
	break;
	case 'cau-hoi':
	$source = "news";
	$template = isset($_GET['id']) ? "news/news_detail" : "news/news";
	$seo->setSeo('type','article');
	$type = $com;
	$title_crumb = "Câu Hỏi Thường Gặp";
	break;
	case 'bao-gia':
	$source = "news";
	$template = isset($_GET['id']) ? "news/news_detail" : "news/news";
	$seo->setSeo('type','article');
	$type = $com;
	$title_crumb = "Báo Giá";
	break;

	case 'khuyen-mai':
	$source = "product";
	$template = "product/product";
	$seo->setSeo('type','object');
	$type = 'san-pham';
	$title_crumb = khuyenmai;
	break;

	case 'thuong-hieu':
	$source = "news";
	$template = isset($_GET['id']) ? "news/news_detail" : "news/news";
	$seo->setSeo('type','article');
	$type = $com;
	$title_crumb = "Thương Hiệu";
	break;

	case 'nha-thiet-ke':
	$source = "product";
	$template = isset($_GET['id']) ? "product/product_thietke_detail" : "product/product";
	$seo->setSeo('type',isset($_GET['id']) ? "article" : "object");
	$type = $com;
	$title_crumb = tacphamnhathietke;
	break;

	case 'product':
	$source = "product";
	$template = isset($_GET['id']) ? "product/product_detail" : "product/simple_product";
	$seo->setSeo('type',isset($_GET['id']) ? "article" : "object");
	$type = 'san-pham';
	$title_crumb = "Products";
	break;

	case 'nong-san':
	$source = "product";
	$template = isset($_GET['id']) ? "product/product_detail" : "product/product";
	$seo->setSeo('type',isset($_GET['id']) ? "article" : "object");
	$type = 'nong-san';
	$title_crumb = "Nông Sản";
	break;

	case 'bat-dong-san':
	$source = "product";
	$template = isset($_GET['id']) ? "product/product_detail" : "product/product";
	$seo->setSeo('type',isset($_GET['id']) ? "article" : "object");
	$type = 'bat-dong-san';
	$title_crumb = "Bất Động Sản";
	break;

	case 'nha-tro':
	$source = "product";
	$template = isset($_GET['id']) ? "product/product_detail" : "product/product";
	$seo->setSeo('type',isset($_GET['id']) ? "article" : "object");
	$type = 'nha-tro';
	$title_crumb = "Nhà TRọ";
	break;
	case 'bo-suu-tap':
	$source = "bosuutap";
	$template =  isset($_GET['id']) ?"product/product" : "product/bosuutap";
	$seo->setSeo('type',"object");
	$type = 'san-pham';
	$title_crumb = bosuutap;
	break;


	case 'tim-kiem':
	$source = "search";
	$template = "product/product";
	$seo->setSeo('type','object');
	$title_crumb = timkiem;
	break;

	case 'tags-san-pham':
	$source = "tags";
	$template = "product/product";
	$type = $url_type;
	$table = $url_tbltag;
	$seo->setSeo('type','object');
	$title_crumb = null;
	break;

	case 'tags-tin-tuc':
	$source = "tags";
	$template = "news/news";
	$type = $url_type;
	$table = $url_tbltag;
	$seo->setSeo('type','object');
	$title_crumb = null;
	break;

	case 'gallery':
	$source = "product";
	$template = isset($_GET['id']) ? "album/album_detail" : "album/album";
	$seo->setSeo('type',isset($_GET['id']) ? "article" : "object");
	$type = $com;
	$title_crumb = "Gallery";
	break;

	case 'video':
	$source = "video";
	$template = "video/video";
	$type = $com;
	$seo->setSeo('type','object');
	$title_crumb = "Video";
	break;

	case 'gio-hang':
	$source = "order";
	$template = 'order/order';
	$title_crumb = giohang;
	$seo->setSeo('type','object');
	break;

	case 'account':
	$source = "user";
	break;

	case 'ngon-ngu':
	if(isset($lang))
	{
		switch($lang)
		{
			case 'vi':
			$_SESSION['lang'] = 'vi';
			break;
			case 'en':
			$_SESSION['lang'] = 'en';
			break;
			default:
			$_SESSION['lang'] = 'vi';
			break;
		}
	}
	$func->redirect($_SERVER['HTTP_REFERER']);
	break;

	case 'sitemap':
	include_once LIBRARIES."sitemap.php";
	exit();

	case '':
	case 'index':
	$source = "index";
	$template ="index/index";
	$seo->setSeo('type','website');
	break;

	default: 
	header('HTTP/1.0 404 Not Found', true, 404);
	include("404.php");
	exit();
}


/* Include sources */
if($source!='') include SOURCES.$source.".php";

if($template=='')
{
	header('HTTP/1.0 404 Not Found', true, 404);
	include("404.php");
	exit();
}
?>