import socket
import codecs
HOST = '127.0.0.1'
PORT = 11111

with socket.socket(socket.AF_INET, socket.SOCK_STREAM) as s:
    s.bind((HOST, PORT))
    s.listen()
    conn, addr = s.accept()
    with conn:
        print('Polaczono ', addr)
        while True:
            data = conn.recv(1024)
            if not data:
                break
            res = codecs.encode(data,"hex")
            print(res)