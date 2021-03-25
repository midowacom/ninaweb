<?php
class Product
{
	private static $d;

	function __construct($d)
	{
		self::$d = $d;
	}
	public static function get_info($pid=0)
	{
		$row = null;
		if($pid)
		{
			$row = self::$d->rawQueryOne("select * from #_product where id = ? limit 0,1",array($pid));
		}
		return $row;
	}
	public static function get_mau($mau=0)
	{
		if($mau > 0)
		{
			return $row = self::$d->rawQueryOne("select id,mau,tenvi,tenen,photo from #_product_mau where id = ? limit 0,1",array($mau));
		}
		return false;
	}
	public static function get_product_mau_images($id_product,$mau){
		if($id_product > 0 && $mau > 0){
			return $row = self::$d->rawQuery("select id,mau,tenvi from #_gallery where id_mau = ? and id_photo=? and type=? and kind='man' and val='san-pham' ",array($mau,$id_product,'san-pham'));
		}
		return false;
	}
	public static function get_size($size=0)
	{
		$str = '';
		if($size > 0)
		{
			return  self::$d->rawQueryOne("select tenvi,tenen from #_product_size where id = ? limit 0,1",array($size));
		}
		return false;
	}

	public static function data_product_exist($code){

		if(!empty($code)){
		$row = self::$d->rawQueryOne("select id from #_product_statistics where code = ? limit 0,1",array($code));
		return (int) $row['id'] > 0;
		}
		return false;
	}

	public static function hash_code($pid,$idmau,$idsize){
		return 'p'.$pid.'-'.'c'.$idmau.'-'.'s'.$idsize;
	}
}