<?php
ini_set( "soap.wsdl_cache_enabled", 0 );
ini_set( 'soap.wsdl_cache_ttl', 0 );
 
function DialCall( $phoneNumber,$uniqueId,$maxRetries,$waitTime,$audioId)
{
 

		 $callFile = "Channel: local/$phoneNumber@from-internal\n";
         $callFile .= "MaxRetries: $maxRetries\n";
         $callFile .= "WaitTime: $waitTime\n";
         $callFile .= "CallerID: $uniqueId\n";
         $callFile .= "Context: callblaster\n";
         $callFile .= "Extension: 333\n";
         $callFile .= "Set: userAudio=$audioId\n";
         $callFile .= "Set: userNumber=$number\n";
         $callFile .= "Set: dbid=$id\n";
         $callFileName = $phoneNumber."_".time().".call";
         file_put_contents("/tmp/$callFileName",$callFile);
         $time=date("c",time());
	try
 	{
        exec("mv /tmp/$callFileName /var/spool/asterisk/outgoing/$callFileName");
        $msg = $time." -- Call file to 1".$number." created -- CSV file: $dest\n";
        $status="Dialled";
    }
    catch(Exception $e)
    {
        $msg=$time." -- ERROR:".$e->getMessage()." -- CSV file : $dest\n";
        $status="Dial Failed";
    }

   



return $status;


}

function GetcallStatus($phoneNumber)

$servername = "localhost";
$username = "root";
$password = "password";

// Create connection
$conn = new mysqli($servername, $username, $password);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT disposition FROM cdr WHERE did = $phoneNumber ORDER BY calldate ASC LIMIT 1;";
$result = $conn->query($sql);

return $result;

}

$server = new SoapServer( "organization.wsdl" );

$server->addFunction( "DialCall" );
$server->addFunction( "GetcallStatus" );
$server->handle();
?>
