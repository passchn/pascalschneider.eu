<?php
session_start();

$settings = json_decode(file_get_contents('../settings.json'), true);
$db_server = $settings['analytics']['db_server'];
$db_user = $settings['analytics']['db_user'];
$db_passwd = $settings['analytics']['db_passwd'];
$db_name = $settings['analytics']['db_name'];

$url = $_SERVER['HTTP_REFERER'];
$ip = md5($_SERVER['REMOTE_ADDR'].'lwlahoh3wazi');
$scheme = $_SERVER['REQUEST_SCHEME'];
$lang = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
$browser = $_SERVER['HTTP_USER_AGENT'];

if (!isset($_SESSION['geo'])) {
    $_SESSION['geo'] = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$_SERVER['REMOTE_ADDR']));
}

$country = $_SESSION['geo']['geoplugin_countryCode'];
$city = $_SESSION['geo']['geoplugin_city'];
$lat = $_SESSION['geo']['geoplugin_latitude'];
$long = $_SESSION['geo']['geoplugin_longitude'];


$mysqli = new mysqli($db_server, $db_user, $db_passwd, $db_name);
$mysqli->set_charset('utf8mb4');

$mysqli->query(" INSERT INTO `analytics` (`url`, `ip`, `scheme`, `lang`, `browser`, `country`, `city`, `latitude`, `longitude`) VALUES ('$url', '$ip', '$scheme', '$lang', '$browser', '$country', '$city', '$lat', '$long') ");

$mysqli->close();

echo json_encode(true);

?>