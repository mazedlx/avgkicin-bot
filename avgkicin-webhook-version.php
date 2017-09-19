<?php
// username avgkicin_bot | Average Everyday Kicin
$botToken = "enter bot token here";
$telegram = 'https://api.telegram.org/bot'.$botToken;


$response = file_get_contents('php://input');
$update = json_decode($response, true);

$chat_id= $update["result"]["message"]["chat"]["id"];
$msg = $update["result"]["message"]["text"];
$sticker = $update["result"]["message"]["sticker"]["file_id"];
if(isset($sticker)){
	answerSticker($telegram, $chat_id);
	$msg = "ex";
}
$msg = strtolower($msg);
// Message processing
switch($msg){
	case "/selam":
		answer($telegram, $chat_id, "alejkumu selam");
		break;
	case "slm":
		answer($telegram, $chat_id, "wslm");
		break;
	case "selam":
		answer($telegram, $chat_id, "alejkumu selam selamdžija");
		break;
	case "šta ima?":
		answer($telegram, $chat_id, "ništa značajno");
		break;
	case "kakav si mi?":
		answer($telegram, $chat_id, "drama");
		break;
	case "kako si?":
		answer($telegram, $chat_id, "drama");
		break;
	case "ex":
		break;
	case "/film":
		getMovie($telegram, $chat_id);
		break;
	case "/tvshow":
		getTVShow($telegram, $chat_id);
		break;
	case "/start":
		intro($telegram, $chat_id);
		break;
	default:
		RandomAnswer($telegram, $chat_id);
}



function answerSticker($telegram, $cID){
	$msg = file(__DIR__ . "/files/stickers.txt");
	$msg = $msg[mt_rand(0, count($msg) - 1)];
	$url = $telegram."/sendSticker?chat_id=".$cID."&sticker=".$msg;
	file_get_contents($url);
}

function answer($telegram, $cID, $msg){
	$url = $telegram."/sendMessage?chat_id=".$cID."&text=".urlencode($msg);
	file_get_contents($url);
}

function getMovie($telegram, $chat_id){
	$movie = file(__DIR__ . "/files/film.csv");
	$msg = $movie[mt_rand(0, count($movie) - 1)];
	answer($telegram, $chat_id, $msg);
}

function getTVShow($telegram, $chat_id){
	$tv = file(__DIR__ . "/files/cucirca.txt");
	$msg = $tv[mt_rand(0, count($tv) - 1)];
	answer($telegram, $chat_id, $msg);
}

function RandomAnswer($telegram, $chat_id){
	$tv = file(__DIR__ . "/files/odg.txt");
	$msg = $tv[mt_rand(0, count($tv) - 1)];
	answer($telegram, $chat_id, $msg);
}

function intro($telegram, $chat_id){
	$msg = "Haj bujrum, ne moraš se izuvat\n";
	answer($telegram, $chat_id, $msg);
}
?>
