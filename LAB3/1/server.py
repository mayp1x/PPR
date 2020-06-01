from xmlrpc.server import SimpleXMLRPCServer
import codecs
def add(a, b):
	print("Otrzymalem wiadomosc:")
	suma = a+b
	return suma;

server = SimpleXMLRPCServer(("localhost", 12345))
server.register_function(add, "add")
server.serve_forever()
