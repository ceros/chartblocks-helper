<?php
header("Access-Control-Allow-Origin: https://preview.ceros.com");
header("Access-Control-Allow-Origin: http://view.ceros.com");
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
require __DIR__ . '/vendor/autoload.php';


use \Firebase\JWT\JWT;

  if (isset($_GET["data"])) {

    $data = $_GET["data"];
    $token = $data["token"];
    $secret = $data["secret"];
    $ids = $data["ids"];

    $iv = '7F06G8JMsvp1TAg+V4xy6DK73C8GjjU3UpqEg/+y6No=';

  $result = array(
    "token" => $token,
    "secret" => $secret,
    "ids" => $ids
  );

  $enc_result = json_encode($result);
  $jwt = JWT::encode($enc_result, $iv);
  
  $return_data = json_encode(array("key" => $jwt));
  echo $return_data;

  }
?>