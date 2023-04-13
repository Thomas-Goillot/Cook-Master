<?php
include_once('Views/layout/dashboard/path.php');


$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.apilayer.com/spoonacular/food/ingredients/search?sortDirection=asc&sort=calories&query=apple&offset=0&number=100&intolerances=egg",
  CURLOPT_HTTPHEADER => array(
    "Content-Type: text/plain",
    "apikey: uJcZp67EZpodT8Vegm9Nuxlmfs6G6a4g"
  ),
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET"
));

$response = curl_exec($curl);

curl_close($curl);
echo "<pre>";
echo $response;
?>