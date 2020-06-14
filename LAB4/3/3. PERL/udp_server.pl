#!/usr/bin/perl
#udp_server.pl
use IO::Socket::INET;
$| = 1;
my ($socket,$received_data);
my ($peeraddress,$peerport);

$socket = new IO::Socket::INET (
LocalPort => '12345',
Proto => 'udp',
) or die "Blad w tworzeniu socketu : $!\n";

#Odbieranie danych/nasłuchiwanie:
while(1)
{
$socket->recv($recieved_data,1024);
$peer_address = $socket->peerhost();
$peer_port = $socket->peerport();
print "\n($peer_address , $peer_port) przekazal informacje : $recieved_data"; #Wypisanie wiadomosci na ekran
#$data = "data from server\n";
#print $socket "$data";
}

$socket->close();