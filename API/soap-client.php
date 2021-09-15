<?php

print "<h2>PHP is Fun!</h2>";
$client = new SoapClient( "http://10.21.27.33:8997/services/AccountService?wsdl", array( 'cache_wsdl' => WSDL_CACHE_NONE ) );


//try 
//{

  $responseLogin = $client->AuthHeader( 'Username'=>'hutch_crm', 'Password'=>'hutch_crm');
  if($responseLogin == "success") 
	{
	print "<h2>PHP is Fun!</h2>";
    $response = $client->QueryAcctBalBO( '94723000005' ); 
	}
echo $response;	


//} 
//catch ( SoapFault $sf ) 
//{
 // echo $sf->getMessage();
print "<h2>PHP is Fun!</h2>";
}
?>
