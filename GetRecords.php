<?php
class Authenticate{
public function doAuthentication(){
require_once ('./ATGenerator.php');
//creating and object of class GenerateAT and calling the method generateToken to get the access token
$a = new GenerateAT();
$aToken=$a->generateToken();
$profileId=469746;
$pageId=3632736;
$b = new Authenticate();
$result=$b->getData($profileId,$pageId,$aToken);//passing the information to the function
var_dump($result);//print the result returned
}
public function getData($profileId,$pageId,$aToken){
	$apiURL='https://app.iformbuilder.com/exzact/api/v60/profiles/'.$profileId.'/pages/'.$pageId.'/records?fields=first_name,last_name,email,age,ssn,address,city,country,phone_number,zip_code&limit=1000&offset=0';
$ch = curl_init();
//making the ssl verification false when we run on local machine
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_URL,$apiURL);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);

curl_setopt($ch, CURLOPT_HTTPHEADER, array(
  "Authorization: Bearer $aToken"
));

$response = curl_exec($ch);  //executing to access the data from the api
//checking if the data is returned without any errors (debugging purpose)
if(curl_exec($ch) === false){
    echo 'Curl error: ' . curl_error($ch);
   }
else{
  curl_close($ch);
  //var_dump($response); can be printed as json data
  $array=(json_decode($response, true));//decoding the json data to array format
  var_dump ($array); 
  }
    
	}
}

//calling doAuthentication function
$c = new Authenticate();
$c->doAuthentication();

?>

