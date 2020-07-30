<?php
  require __DIR__ . '/vendor/autoload.php';

  use \ChartBlocks\Client as Client;
  use \ChartBlocks\DataSet\Row as Row;
  use \Firebase\JWT\JWT;



  header("Access-Control-Allow-Origin: https://preview.ceros.com");
  header("Access-Control-Allow-Origin: http://view.ceros.com");
  header("Access-Control-Allow-Origin: *");

  $iv = '7F06G8JMsvp1TAg+V4xy6DK73C8GjjU3UpqEg/+y6No=';

  // echo "in the chartblocks helper file \n";

  $body = $_GET['data'];
  $arr; $token; $secret; $set;

  
  if ($body) {
    $arr = $body{"body"};
    $key = $body{"key"};

    
    $decoded = JWT::decode($key, $iv, array('HS256'));
    $json_stats = json_decode($decoded, true);

    $token = $json_stats["token"];
    $secret = $json_stats["secret"];
    $set = $json_stats["ids"];
    
    echo "token is " . $token . " \n";
    echo "secret is " . $secret . " \n";
    echo "set is " . $set . " \n";
  
  
    $client = new Client(array(
      'token' => $token,
      'secret' => $secret
    ));
  
    
    $dataSets = $client->getRepository('dataSet');
    $myDataSet = $dataSets->findById($set);
    
    
    $data = $myDataSet->data;
  
  
    $data->truncate();
  
  
    if ($arr) {
      foreach($arr as $sub_arr) {
        $data->append(array(
          new Row(null, $sub_arr)
        ));
      }
    
    }
  }
  
 
  
?>