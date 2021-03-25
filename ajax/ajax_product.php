<?php 
include "ajax_config.php";
/* Paginations */
include LIBRARIES."class/class.PaginationsAjax.php";

$pagingAjax = new PaginationsAjax();
$pagingAjax->perpage = (htmlspecialchars($_GET['perpage']) && $_GET['perpage'] > 0) ? htmlspecialchars($_GET['perpage']) : 1;
$eShow = htmlspecialchars($_GET['eShow']);
$etype = htmlspecialchars($_GET['type']);
$idlist = (isset($_GET['idlist']) && $_GET['idlist'] > 0) ? htmlspecialchars($_GET['idlist']) : 0;
$p = (isset($_GET['p']) && $_GET['p'] > 0) ? htmlspecialchars($_GET['p']) : 1;
$start = ($p-1) * $pagingAjax->perpage;
$pageLink = "ajax/ajax_product.php?perpage=".$pagingAjax->perpage;
$tempLink = "";
$where = "";

/* Math url */
if($idlist)
{
	$tempLink .= "&idlist=".$idlist;
	$where .= " and id_list = ".$idlist;
}
if($etype)
{
	$tempLink .= "&type=".$etype;
	$where .= " and type = '".$etype."' ";
}
$tempLink .= "&p=";
$pageLink .= $tempLink;

/* Get data */
$sql = "select * from #_product where hienthi > 0 $where and noibat > 0  order by stt,id desc";
$sqlCache = $sql." limit $start, $pagingAjax->perpage";
$items = $cache->getCache($sqlCache,'result',7200);
/* Count all data */
$countItems = count($cache->getCache($sql,'result',7200));

/* Get page result */
$pagingItems = $pagingAjax->getAllPageLinks($countItems, $pageLink, $eShow);


$deviceType = null;
$deviceType = ($detect->isMobile() || $detect->isTablet()) ? 'mobile' : 'computer';
if($deviceType == 'computer'){ ?>
<?php if($countItems) { ?>
	<?=$func->get_product_tpl($items,$etype)?>
	<div class="pagination-ajax"><?=$pagingItems?></div>
<?php } }else{?>
<?php if($countItems) { ?>
	<?=$func->get_product_tpl_mobile($items)?>
	<div class="pagination-ajax"><?=$pagingItems?></div>
<?php } ?>
<?php } ?>