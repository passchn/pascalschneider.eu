<?php
session_start();

include_once '../settings.php';

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

try {
    $mysqli = new mysqli(DB_SERVER, DB_USER, DB_PASSWD, DB_NAME);
    $mysqli->set_charset('utf8mb4');

    $mysqli->query(" INSERT INTO `analytics` (`url`, `ip`, `scheme`, `lang`, `browser`, `country`, `city`, `latitude`, `longitude`) VALUES ('$url', '$ip', '$scheme', '$lang', '$browser', '$country', '$city', '$lat', '$long') ");

    $mysqli->close();

    http_response_code(200);
} 
catch (exception $e) {
    http_response_code(404);
    echo $e; 
}
finally {
    echo json_encode([
        'ip' => $ip,
        'city' => $city
    ]);
}

?>