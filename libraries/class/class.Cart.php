<?php
class Cart
{
	private $d;

	function __construct($d)
	{
		$this->d = $d;
	}

	public function get_product_gia($pid,$quantity=1){
		global $func;
		$row = $this->get_product_info($pid);
		// $quantprice = $this->d->rawQueryOne("select gia from #_product_quanprice where id_product= ? and (from_quantity <= ? and to_quantity >= ?)",array($pid,$quantity,$quantity));

		$quantprice = $this->d->rawQueryOne("select gia from #_product_quanprice where id_product= ? and id=? ",array($pid,$quantity));

		if(!empty($quantprice)){
			return $quantprice['gia'];
		}
		$max_from_q = $this->d->rawQueryOne("select from_quantity as max,gia from #_product_quanprice where id_product= ? order by from_quantity desc limit 1",array($pid));
		$max_to_q = $this->d->rawQueryOne("select to_quantity as max,gia from #_product_quanprice where id_product= ? order BY to_quantity limit 1",array($pid));
		$from_quantity = $max_from_q['max'];
		$to_quantity = $max_to_q['max'];
		if($from_quantity > $to_quantity && $quantity >= $from_quantity){
			return $max_from_q['gia'];
		}
		if($to_quantity > $from_quantity && $quantity >=  $to_quantity){
			return $max_to_q['gia'];
		}
		return $row['gia'];
	}
	public function get_product_info($pid=0)
	{
		$row = null;
		if($pid)
		{
			$row = $this->d->rawQueryOne("select * from #_product where id = ? limit 0,1",array($pid));
		}
		return $row;
	}

	public function get_product_mau($mau=0)
	{
		$str = '';
		if($mau)
		{
			$row = $this->d->rawQueryOne("select tenvi from #_product_mau where id = ? limit 0,1",array($mau));
			$str = $row['tenvi'];
		}
		return $str;
	}

	public function get_product_size($size=0)
	{
		$str = '';
		if($size)
		{
			$row = $this->d->rawQueryOne("select tenvi from #_product_size where id = ? limit 0,1",array($size));
			$str = $row['tenvi'];
		}
		return $str;
	}

	public function remove_product($code='')
	{
		if(isset($_SESSION['cart']) && $code != '')
		{
			$max = count($_SESSION['cart']);

			for($i=0;$i<$max;$i++)
			{
				if($code == $_SESSION['cart'][$i]['code'])
				{
					unset($_SESSION['cart'][$i]);
					break;
				}
			}

			$_SESSION['cart'] = array_values($_SESSION['cart']);
		}
	}

	public function get_order_total()
	{
		global $func,$login_member;
		$sum = 0;

		if(isset($_SESSION['cart']))
		{
			$max = count($_SESSION['cart']);

			for($i=0;$i<$max;$i++)
			{
				$pid = $_SESSION['cart'][$i]['productid'];
				$quanprice = $_SESSION['cart'][$i]['quanprice'];
				$q = $_SESSION['cart'][$i]['qty'];
				$price = $this->get_product_gia($pid,$quanprice);
				$sum += ($price * $q);
			}
			if($func->checkMemberLogin()){
				$id_member = $_SESSION[$login_member]['id'];
				$member = Member::info($id_member,array("id_member_group"));
				$member_group = Member::info_group($member["id_member_group"],array("chietkhau"));
				$sum = $sum * (100 - $member_group["chietkhau"])/100;
			}
			return $sum;
		}

	}
	public function get_order_total_ship()
	{
		
	}
	public function get_order_total_tamtinh()
	{
		global $func,$login_member;
		$sum = 0;

		if(isset($_SESSION['cart']))
		{
			$max = count($_SESSION['cart']);

			for($i=0;$i<$max;$i++)
			{
				$pid = $_SESSION['cart'][$i]['productid'];
				$quanprice = $_SESSION['cart'][$i]['quanprice'];
				$q = $_SESSION['cart'][$i]['qty'];
				$price = $this->get_product_gia($pid,$quanprice);
				$sum += ($price * $q);
			}
			
			return $sum;
		}

	}


	public function addtocart($q=1, $pid=0, $mau=0, $size=0,$quanprice=0)
	{
		if($pid<1 or $q<1) return;
		$code = md5($pid.$mau.$size.$quanprice);

		$check_size = $this->d->rawQueryOne("select quantity from #_product_statistics where id_product=? and id_mau=? and id_size=? ",array($pid,$mau,$size));
		if($check_size){
			if($check_size['quantity'] < $q){
				$result = array(
					'status' => "fail",
					'msg' => _not_enough_items
				);
				return json_encode($result);
			}
		}
		

		

		if(isset($_SESSION['cart']))
		{
			if(!$this->product_exists($code,$q))
			{
				$max = count($_SESSION['cart']);
				$_SESSION['cart'][$max]['productid'] = $pid;
				$_SESSION['cart'][$max]['qty'] = $q;
				$_SESSION['cart'][$max]['mau'] = $mau;
				$_SESSION['cart'][$max]['size'] = $size;
				$_SESSION['cart'][$max]['code'] = $code;
				$_SESSION['cart'][$max]['quanprice'] = $quanprice;
				$result = array(
					'status' => "success",
					'msg' => "success"
				);
			}
		}
		else
		{
			$_SESSION['cart'] = array();
			$_SESSION['cart'][0]['productid'] = $pid;
			$_SESSION['cart'][0]['qty'] = $q;
			$_SESSION['cart'][0]['mau'] = $mau;
			$_SESSION['cart'][0]['size'] = $size;
			$_SESSION['cart'][0]['code'] = $code;
			$_SESSION['cart'][0]['quanprice'] = $quanprice;
			$result = array(
				'status' => "success",
				'msg' => "success"
			);
		}
		return json_encode($result);
	}

	private function product_exists($code='', $q=1)
	{
		$flag = 0;

		if(isset($_SESSION['cart']) && $code != '')
		{
			$q = ($q>1)?$q:1;
			$max = count($_SESSION['cart']);

			for($i=0;$i<$max;$i++)
			{
				if($code == $_SESSION['cart'][$i]['code'])
				{
					$_SESSION['cart'][$i]['qty'] += $q;
					$flag = 1;
				}
			}
		}

		return $flag;
	}
}
?>