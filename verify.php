<?php
/*
کانال ساتا سورس ! پر از سورس هاي ربات هاي تلگرامي !
لطفا در کانال ما عضو شويد 
@satasource
https://t.me/mohammad_576
*/
define('API',"Token"); //محل توکن
function Send($ci, $text){
	$data  = "https://api.telegram.org/bot".API."/SendMessage?";
	$data .= "chat_id=".$ci."&text=".urlencode($text);
	file_get_contents($data);
}
$pay = $_GET['pay'];
$from = $_GET['from'];
$coin = file_get_contents("data/$from/price.txt");
$MerchantID = 'مرچند کد';
$Amount = $pay; //Amount will be based on Toman
$Authority = $_GET['Authority'];

if ($_GET['Status'] == 'OK') {

$client = new SoapClient('https://www.zarinpal.com/pg/services/WebGate/wsdl', ['encoding' => 'UTF-8']);

$result = $client->PaymentVerification(
[
'MerchantID' => $MerchantID,
'Authority' => $Authority,
'Amount' => $Amount,
]
);

if ($result->Status == 100) {
echo 'خرید با موفقیت انجام شد کد پیگیری : '.$result->RefID;
Send($from, "پرداخت انجام شد به مبلغ $pay تومان\n کد پیگیری : ".$result->RefID);
$temp = $coin + $pay;
file_put_contents("data/$from/price.txt",$temp);
} else {
echo 'خرید انجام نشد :'.$result->Status;
Send($from, 'خرید انجام نشد :'.$result->Status);
}
} else {
echo 'پرداخت کنسل شد';
Send($from, "خرید انجام نشد کنسل شد");
header('location: https://t.me/یوزرنیم ربات');
}
/*
کانال ساتا سورس ! پر از سورس هاي ربات هاي تلگرامي !
لطفا در کانال ما عضو شويد 
@satasource
https://t.me/satasource
*/
?>