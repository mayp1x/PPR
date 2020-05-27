from xmlrpc.server import SimpleXMLRPCServer
import codecs
def show(n):
	print("Otrzymalem wiadomosc:")
	print(n)
	return 0

server = SimpleXMLRPCServer(("localhost", 12346))
server.register_function(show, "show")
server.serve_forever()
