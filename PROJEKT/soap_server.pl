#!/usr/bin/perl

use warnings;
use strict;
use HTTP::Daemon;
use XML::RPC;
use SOAP::Lite;
my $result = 0;
my $client = SOAP::Lite->service("http://localhost:8000/?wsdl");
#=======================================================================
sub handler {
    my ( $method, @params ) = @_;
    print $result = $client->podajDalej(@params);
    return {params => \@params };
}
#=======================================================================
my $port 	= 12345;
my $host 	= '127.0.0.1';
# HTTP server ----------------------------------------------------------
my $server = HTTP::Daemon->new( 
	LocalAddr => $host,
	LocalPort => $port,
) || die "HTTP::Daemon->new(): $!\n";

# XML-RPC broker -------------------------------------------------------
my $xmlrpc 	= XML::RPC->new();

# Process --------------------------------------------------------------
while( my $client = $server->accept ){
	#-------------------------------------------------------------------
	#fork and next;		# multi-processing
	#-------------------------------------------------------------------
	while( my $req = $client->get_request ){
		my $msg = $xmlrpc->receive( $req->content, \&handler );
		my $res = HTTP::Response->new( 200 );
		$res->content( $msg );
		print $msg;
		$client->send_response( $res );
	}
	#-------------------------------------------------------------------
	$client->close;
	#-------------------------------------------------------------------
	#exit 0;			# multi-processing
	#-------------------------------------------------------------------
}
#=======================================================================
exit( 0 );
