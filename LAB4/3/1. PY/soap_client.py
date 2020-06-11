from zeep import Client

client = Client('http://localhost:8000/?wsdl')
usr_input = input('Podaj tekst do przesuniecia: ')
result = client.service.stringShift(usr_input)

print(result)