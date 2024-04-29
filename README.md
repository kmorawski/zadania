# Napisz zestaw klas:
* klasę pozwalająca na odczyt zawartości pliku tekstowego - linia po linii,
  zachowując newline'y,
* klasę zamieniającą znaki końca linii na Unixowe, wykorzystując wzorzec
  projektowy dekorator,
* klasę proxującą (wzorzec proxy), która, jeśli plik nie jest dostępny, pobierze go z
  zadanego zasobu internetowego,
* klasę, stosującą wzorzec strategia, która optymalizuje odczyt małego pliku vs
  bardzo dużego pliku.

# Napisz testy jednostkowe (PHPUnit):
* dla każdej z utworzonych klas.
##  Środowisko:
* PHP 8.2,
* bez użycia bibliotek zewnętrznych (poza phpunit/phpunit).