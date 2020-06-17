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
$server->register("stringShift"
    , array('shiftMe' => 'xsd:string')
    , array('return' => 'xsd:string')
    , $namespace
    , false
    , 'rpc'
    , 'encoded'
    , 'Funkcja przesuwająca tekst o 1 w prawo.'
);

#Funkcja przesuwajaca lancuch o 1 w prawo
function stringShift($shiftMe)
{
     $string = $shiftMe;
     $shift = 1;
     $result = "";
     $server_ip   = '127.0.0.1';
     $server_port = 12345;
     $beat_period = 5;
     for ($i = 0; $i < strlen($string); $i++)
     {
          $ascii = ord($string[$i]);
          $shiftedChar = chr($ascii + $shift);
          $result .= $shiftedChar;
     }
     $message = $result;
	 
	 #Tworzenie socketu UDP
     if ($socket = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP)) {
          while (1) {
               socket_sendto($socket, $message, strlen($message), 0, $server_ip, $server_port);
               print "Time: " . date("%r") . "n";
               sleep($beat_period);
          }
     } else {
          print("can't create socket");
     }
    return new soapval('return', 'xsd:string', $result);
}
$postdata = file_get_contents("php://input");
$postdata = isset($postdata) ? $postdata : '';
$server->service($postdata);
?>
      