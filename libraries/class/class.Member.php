<?php 
class Member{
	private static $d;
	function __construct($d)
	{
		self::$d = $d;
	}

	public static function info_group($pid, $arr = array("*")){
		$row = null;
		if($pid)
		{
			$row = self::$d->rawQueryOne("select ".implode(',', $arr)." from #_member_group where id = ? limit 0,1",array($pid));
		}
		return $row;
	}

	public static function info($pid,$arr = array("*")){
		$row = null;
		if($pid)
		{
			$row = self::$d->rawQueryOne("select ".implode(',', $arr)." from #_member where id = ? limit 0,1",array($pid));
		}
		return $row;
	}
	public static function getMemberGroupName($id){
		$name =  self::info_group($id,array("id","title"));
		return   $name["title"];
	}
}