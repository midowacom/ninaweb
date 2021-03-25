<?php 
	include "ajax_config.php";

	/* Paginations */
	include LIBRARIES."class/class.PaginationsAjax.php";
	$pagingAjax = new PaginationsAjax();
	$pagingAjax->perpage = (htmlspecialchars($_GET['perpage']) && $_GET['perpage'] > 0) ? htmlspecialchars($_GET['perpage']) : 1;
	$eShow = htmlspecialchars($_GET['eShow']);
	$idList = (isset($_GET['idList']) && $_GET['idList'] > 0) ? htmlspecialchars($_GET['idList']) : 0;
	$newsType = (isset($_GET['type']) && !empty($_GET['type'])) ? htmlspecialchars($_GET['type']) : 'tin-tuc';
	$p = (isset($_GET['p']) && $_GET['p'] > 0) ? htmlspecialchars($_GET['p']) : 1;
	$start = ($p-1) * $pagingAjax->perpage;
	$pageLink = "ajax/ajax_news.php?perpage=".$pagingAjax->perpage;
	$tempLink = "";
	$where = "";

	/* Math url */
	if($idList)
	{
		$tempLink .= "&idList=".$idList;
		$where .= " and id_list = ".$idList;
	}

	if($newsType)
	{
		$tempLink .= "&type=".$newsType;
		$where .= " and type ='".$newsType."'";
	}

	$tempLink .= "&p=";
	$pageLink .= $tempLink;

	/* Get data */
	$sql = "select * from #_news where hienthi > 0 $where and noibat > 0 order by stt,id desc";
	$sqlCache = $sql." limit $start, $pagingAjax->perpage";

    $items = $cache->getCache($sqlCache,'result',7200);
	/* Count all data */
	$countItems = count($cache->getCache($sql,'result',7200));

	/* Get page result */
	$pagingItems = $pagingAjax->getAllPageLinks($countItems, $pageLink, $eShow);
?>
<?php if($countItems) { ?>
	<div class="row">
		<?php foreach($items as $item) { ?>
			<div class="col-md-3 col-sm-4 col-6">
				<?=$func->get_news_item($item)?>
			</div>
		<?php } ?>
	</div>
	<div class="pagination-ajax"><?=$pagingItems?></div>
<?php } ?>