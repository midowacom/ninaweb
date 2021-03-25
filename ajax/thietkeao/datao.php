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


$func->dump($_POST,1);

$data['hoten'] = magic_quote($_POST['hoten']);
$data['email'] = magic_quote($_POST['email']);
$data['dienthoai'] = magic_quote($_POST['dienthoai']);
$data['diachi'] = magic_quote($_POST['diachi']);
$data['ghichu'] = magic_quote($_POST['ghichu']);
$data['giaban'] = (int)$_POST['giaban'];
$data['link_image'] = magic_quote($_POST['link_images']);
$data['ngaytao'] = time();
$data['hienthi'] = 1;

$data['type'] = 'datao';
$data['view'] = 0;
$sz = array();
$cz = '';
$tz = 0;
foreach ($_POST['size'] as $key => $value) {
	if($value!=0){
		$sz['size'][$key] = $value;
		$tz += $value;
		$d->reset();
		$sql = "select * from #_size where type='size' and id='".$key."' and hienthi=1";
		$d->query($sql);
		$item_sizes = $d->fetch_array();
		$cz .= '<p>Size '.$item_sizes['ten_'.$lang].': '.$value.' bộ</p>';
	}
}
$sz['total'] = $tz;
$sz['str'] = $cz;
$data['size'] = json_encode($sz,JSON_UNESCAPED_UNICODE);
$d->setTable('datao');
if($d->insert($data)){
	include_once "../phpMailer/class.phpmailer.php";
	$mail = new PHPMailer();
	$mail->Priority = 1;
	$mail->AddCustomHeader("X-MSMail-Priority: High");
		$mail->IsSMTP(); // Gọi đến class xử lý SMTP
		$mail->Host       = $config_ip; // tên SMTP server
		$mail->Port       = 587;
		$mail->SMTPDebug  = 0;
		$mail->SMTPAuth   = true;
		$mail->SMTPSecure = "";                 // Sử dụng đăng nhập vào account
		$mail->Username   = $config_email; // SMTP account username
		$mail->Password   = $config_pass;
		//Thiet lap thong tin nguoi gui va email nguoi gui
		$mail->SetFrom($row_setting['email'],$row_setting['ten_'.$lang]);
		
		$mail->AddAddress($row_setting['email'],$row_setting['ten_'.$lang]);
		$mail->AddAddress($data['email'],$row_setting['ten_'.$lang]);
		
		/*=====================================
		* THIET LAP NOI DUNG EMAIL
		*=====================================*/
		//Thiết lập tiêu đề
		$mail->Subject    = '['.$_POST['hoten'].']';
		$mail->IsHTML(true);
		//Thiết lập định dạng font chữ
		$mail->CharSet = "utf-8";
		$body = '<table style="width: 100%; border: 1px solid #1a1a1a; border-collapse: collapse;">';
		$body .= '
		<tr>
		<th style="text-align: left; padding: 10px 10px; color: #FFF; background: #1a1a1a; text-transform: uppercase; font-size: 20px;" colspan="2">Thông tin đặt áo</th>
		</tr>
		<tr>
		<th style="text-align: left; border: 1px solid #1a1a1a; width: 120px; padding: 5px 10px; color: #1a1a1a;">Họ tên :</th><td style="padding: 5px 10px; text-align: left; border: 1px solid #1a1a1a;">'.$_POST['hoten'].'</td>
		</tr>
		<tr>
		<th style="text-align: left; border: 1px solid #1a1a1a; width: 120px; padding: 5px 10px; color: #1a1a1a;">Điện thoại :</th><td style="padding: 5px 10px; text-align: left; border: 1px solid #1a1a1a;">'.$_POST['dienthoai'].'</td>
		</tr>
		<tr>
		<th style="text-align: left; border: 1px solid #1a1a1a; width: 120px; padding: 5px 10px; color: #1a1a1a;">Email :</th><td style="padding: 5px 10px; text-align: left; border: 1px solid #1a1a1a;">'.$_POST['email'].'</td>
		</tr>
		<tr>
		<th style="text-align: left; border: 1px solid #1a1a1a; width: 120px; padding: 5px 10px; color: #1a1a1a;">Địa chỉ :</th><td style="padding: 5px 10px; text-align: left; border: 1px solid #1a1a1a;">'.$_POST['diachi'].'</td>
		</tr>
		<tr>
		<th style="text-align: left; border: 1px solid #1a1a1a; width: 120px; padding: 5px 10px; color: #1a1a1a;">Số lượng :</th><td style="padding: 5px 10px; text-align: left; border: 1px solid #1a1a1a;">'.$cz.'</td>
		</tr>
		<tr>
		<th style="text-align: left; border: 1px solid #1a1a1a; width: 120px; padding: 5px 10px; color: #1a1a1a;">Nội dung :</th><td style="padding: 5px 10px; text-align: left; border: 1px solid #1a1a1a;">'.$_POST['ghichu'].'</td>
		</tr>
		';
		$body .= '</table>';
		$mail->Body = $body;
		if($data['link_image']){
			$mail->AddAttachment(str_replace('http://sbsport.vn/','../',$data['link_image']));
		}

		if($mail->Send()){
			$e['s'] = 1;
			$e['m'] = 'Đã gửi thành công';
		} else {
			$e['s'] = 0;
			$e['m'] = 'Đã gửi thất bại';
		}

		echo json_encode($e);
	}
	?>