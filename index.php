<?php
$botToken = "$_ENV['BOT_TOKEN']";
$website = "https://api.telegram.org/bot".$botToken;

$update = file_get_contents('php://input');
$update = json_decode($update, True);

$config = [
    'mysql_host' => '$_ENV['MYSQL_HOST']',
    'mysql_user' => '$_ENV['MYSQL_USER']',
    'mysql_password' => '$_ENV['MYSQL_PASSWORD']',
    'mysql_db' => '$_ENV['MYSQL_DB']'
];

$mysqli = new mysqli(
    $config['mysql_host'],
    $config['mysql_user'],
    $config['mysql_password'],
    $config['mysql_db']
);

$mysqli->query("set names utf8mb4_general_ci");

$text = $update['message']['text'];
$chatId = $update['message']['chat']['id'];
$userId = $update['message']['from']['id'];
$photo = $update['message']['file_id'];

function sendMessage($chatId, $text) {
    $url = $GLOBALS[website]."/sendMessage?chat_id=$chatId&parse_mode=HTML&text=".urlencode($text);
    file_get_contents($url);
}

function sendPhoto($chatId, $photo) {
    $url = $GLOBALS[website]."/sendPhoto?chat_id=$chatId&photo=$photo&parse_mode=HTML&text=".urlencode($text);
    file_get_contents($url);
}

include "/var/www/html/dog/assets/start.php";
include "/var/www/html/dog/assets/help.php";
include "/var/www/html/dog/assets/commands.php";
?>