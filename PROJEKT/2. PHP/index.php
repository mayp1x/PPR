<?php
require __DIR__ . '/vendor/autoload.php';
$server = new nusoap_server();
$namespace = '127.0.0.1';
$server->configureWSDL('PPR', $namespace);
$server->wsdl->schemaTargetNamespace = $namespace;
$server->register("podajDalej"
    , array('podajMnie' => 'xsd:string')
    , array('return' => 'xsd:string')
    , $namespace
    , false
    , 'rpc'
    , 'encoded'
    , 'Podaj dalej nie bądź sknera.'
);
function podajDalej($podajMnie)
{
     $string = $podajMnie;
     $message = $podajMnie;

     $fp = fsockopen("127.0.0.1", 11111, $errno, $errstr, 30);
     if (!$fp) {
     echo "$errstr ($errno)<br />\n";
     } 
     else {
          fwrite($fp, $podajMnie);
          while (!feof($fp)) {
               echo fgets($fp, 128);
          }
          fclose($fp);
     }
	error_log("PODANO: " . $message);
     return new soapval('return', 'xsd:string', $message);
}
$postdata = file_get_contents("php://input");
$postdata = isset($postdata) ? $postdata : '';
$server->service($postdata);
?>
      