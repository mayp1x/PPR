#PYTHON(proces I)
from zeep import Client

client = Client('http://localhost:8000/?wsdl') #Ustalenie lokalizacji wsdl
usr_input = input('Podaj tekst do przesuniecia: ') #Pobranie danych z wejscia
result = client.service.stringShift(usr_input) #Przekazanie pobranych danych
print(result)