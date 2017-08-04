<?php
use Firebase\JWT\JWT;
class GenerateAT
{
public function generateToken()
	{
require_once ('./vendor/autoload.php');
require_once ('./private/ClientDetails.php');
//preparing the claimset
$token = array(
    "iss" => $clientKey,
    "aud" => "https://app.iformbuilder.com/exzact/api/oauth/token",
	"iat" => time(), //using the time function to calculate current time
	"exp" => time()+(9*60) //adding 9 minutes to calculate to the current time
);
//usede try catch blocks so that we can know if there are any exceptions
try{
	$api_url = 'https://app.iformbuilder.com/exzact/api/oauth/token';
	$jwt = JWT::encode($token, $key); //encoding the claimset and the key so as to modify it into base64 url encoding
	JWT::$leeway = 600; 
	$decoded = JWT::decode($jwt, $key, array('HS256'));
	$decoded_array = (array) $decoded;
	//post parameters
	$postfields = array(
      'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',
      'assertion' => $jwt
    ); 
//using curl to post the data
    $ch = curl_init();
//making the ssl verification false when we run on local machine
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); 
    curl_setopt($ch, CURLOPT_URL, 'https://app.iformbuilder.com/exzact/api/oauth/token');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_VERBOSE, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postfields));
    $result = curl_exec($ch);
	$array=(json_decode($result, true));
	//using if else statements to check if there are any errors
	if(curl_exec($ch) === false) {
    echo 'Curl error: ' . curl_error($ch);
    }
	else{   
     curl_close($ch);
	 $at=($array["access_token"]);
	 return $at;
     }

}
catch(Firebase\JWT\ExpiredException $e){
         echo 'Caught exception: ',  $e->getMessage(), "\n";
    }
	}
}

?>