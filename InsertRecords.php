<?php
class Authenticate{

public function insertData(){
	
require_once ('./ATGenerator.php');
//creating and object of class GenerateAT and calling the method generateToken to get the access token
$a = new GenerateAT();
$aToken=$a->generateToken();
$profileId=469746;
$pageId=3632736;
//data to be inserted and please follow the same convention 
$first_name="Justin";
$last_name="Nuwi";
$email="justin@gmail.com";
$age=23;
$ssn="345-67-8921";
$phone_number="(345) 723-8976";
$address="219 nasa parkway";
$city="Dreamland";
$country="UnitedStates";
$zip_code="73410";
//creating variable to insert data into the database

$ch = curl_init();
$atoken="d3aaeb8882c53072116e7a91dd87a0bb2fbc355a";
curl_setopt($ch, CURLOPT_URL, "https://app.iformbuilder.com/exzact/api/v60/profiles/".$profileId."/pages/".$pageId."/records");
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);

curl_setopt($ch, CURLOPT_POST, TRUE);

//posting all the fileds
curl_setopt($ch, CURLOPT_POSTFIELDS, "{
  \"fields\": [
   {
      \"element_name\": \"first_name\",
      \"value\": \"$first_name\"
    },
	{
      \"element_name\": \"last_name\",
      \"value\": \"$last_name\"
    },
	{
      \"element_name\": \"email\",
      \"value\": \"$email\"
    },
	{
      \"element_name\": \"age\",
      \"value\": \"$age\"
    },
	{
      \"element_name\": \"ssn\",
      \"value\": \"$ssn\"
    },
	{
      \"element_name\": \"phone_number\",
      \"value\": \"$phone_number\"
    },{
      \"element_name\": \"address\",
      \"value\": \"$address\"
    },{
      \"element_name\": \"city\",
      \"value\": \"$city\"
    },
	{
      \"element_name\": \"country\",
      \"value\": \"$country\"
    },
	{
      \"element_name\": \"zip_code\",
      \"value\": \"$zip_code\"
    }
  ]
}");

curl_setopt($ch, CURLOPT_HTTPHEADER, array(
  "Content-Type: application/json",
  "Authorization: Bearer $aToken"
));

$response = curl_exec($ch);
curl_close($ch);
var_dump($response);
echo "<br/>"; 
echo "Succesfully Inserted into the database";
    
	}
}

//calling insertData function
$b = new Authenticate();
$b->insertData();

?>