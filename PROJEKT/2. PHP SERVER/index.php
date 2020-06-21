<?php
require __DIR__ . '/vendor/autoload.php';

#w wierzu poleceń, w lokalizacji folderu z 2.PHP uruchamiam:
#php -S localhost:8000

#Konfiguracja serwera SOAP
$server = new nusoap_server();
$namespace = '127.0.0.1';
$server->configureWSDL('PPR', $namespace);
$server->wsdl->schemaTargetNamespace = $namespace;
#Rejestracja funkcji
$server->register("podajDalej"
    , array('podajMnie' => 'xsd:string')
    , array('return' => 'xsd:string')
    , $namespace
    , false
    , 'rpc'
    , 'encoded'
    , 'Podaj dalej nie bądź sknera.'
);

#Funkcja przesuwajaca lancuch o 1 w prawo
function podajDalej($podajMnie)
{
     $string = $podajMnie;
     $shift = 1;
     $result = "";
     $server_ip   = '127.0.0.1';
     $server_port = 11111;
     $beat_period = 5;
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
      