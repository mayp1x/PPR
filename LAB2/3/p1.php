<?php
$server = '127.0.0.1';
$port = 12345;
if(!($sock = socket_create(AF_INET, SOCK_DGRAM, 0)))
{
	$errorcode = socket_last_error();
    $errormsg = socket_strerror($errorcode);
    
}
while(1)
{
	echo 'Wpisz tekst do wyslania : ';
	$input = readline();
	echo $input;
	if( !socket_sendto($sock, $input , strlen($input) , 0 , $server , $port)){
		$errorcode = socket_last_error();
		$errormsg = socket_strerror($errorcode);
		echo "Nie moglem wyslac tekstu: [$errorcode] $errormsg \n";
	}
}

?>
