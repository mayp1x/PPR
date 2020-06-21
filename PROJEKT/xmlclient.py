import xmlrpc.client

with xmlrpc.client.ServerProxy("http://127.0.0.1:12345/") as proxy:
    print(proxy.method('witam'))

 #   my $result = 0;
 #   my $client = SOAP::Lite->service("http://localhost:8000/?wsdl");
# $result = $client->stringShift('hi');