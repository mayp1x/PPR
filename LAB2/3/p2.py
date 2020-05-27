import socket
import xmlrpc.client
import codecs
localIP     = "127.0.0.1"
localPort   = 12345
bufferSize  = 1024
UDPServerSocket = socket.socket(family=socket.AF_INET, type=socket.SOCK_DGRAM)
UDPServerSocket.bind((localIP, localPort))
print("Nasluchuje IP: " + localIP + " Port: " + str(localPort))
with xmlrpc.client.ServerProxy("http://localhost:12346/") as proxy:
	while(True):
		bytesAddressPair = UDPServerSocket.recvfrom(bufferSize)
		message = bytesAddressPair[0]
		formatted_message = message.decode("utf-8")
		temp = codecs.encode(message,"hex")
		proxy.show(temp)
