<?php
//call library 
require_once ('./lib/nusoap.php'); 


// create the function 
function get_message($your_name, $surname) 
{ 
if(!$your_name){ 
return new soap_fault('Client','','Put Your Name!'); 
} 
$result = "Welcome to ".$your_name."ddd".$surname; 
return $result; 
} 

//using soap_server to create server object 
$server = new soap_server; 

//register a function that works on server 
//$server->register('get_message'); 
$server->configureWSDL('myname', 'urn:mynamespace');
$server->register('get_message',
    array('your_name' => 'xsd:string',      'surname' => 'xsd:string'),
    array('output' => 'xsd:string'),
    'xsd:mynamespace');
	
if ( !isset( $HTTP_RAW_POST_DATA ) ) $HTTP_RAW_POST_DATA =file_get_contents( 'php://input' );
// create HTTP listener 
$server->service($HTTP_RAW_POST_DATA); 
exit(); 
?>

