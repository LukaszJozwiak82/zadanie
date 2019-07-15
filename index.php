<?php
class AccessClass implements ArrayAccess {
    private $container = [];
    private $int; 

    public function __construct($int) {
        $this->int = $int;
        //konwersja liczby do postaci binarnej
        $bin = decbin($this->int);

        if($int > 4294967295){
            throw new \Exception('za duża liczba');
        }
        //zapis do tablicy
        for($i = 0; $i <= strlen($bin)-1; $i++){
            $this->container[$i] = $bin[$i];
        }
      }

    //metody wymagane przez interfejs ArrayAccess 
    public function offsetSet($offset, $value) {
        
        //warunek sprawdzający czy nie została przekroczona ilość elementów w tablicy
        if ($offset > count($this->container)) {
            throw new \Exception('zakres przekroczony');
        }

        //warunek sprawdzający czy istnieje klucz w tablicy
        if (!array_key_exists($offset, $this->container)) {
            throw new \Exception('nie ma takiego klucza w tablicy');
        }

        //warunek sprawdzający czy zmieniana wartość nie jest liczbą typu int
        if (!is_int($value)){
            throw new \Exception('zmieniana wartość musi być typu Int');
        }

        //warunek sprawdzający czy wprowadzona wartość jest 0 lub 1
        if ($value != 0 || $value != 1){
            throw new \Exception('zmieniana wartość musi być 0 lub 1');
        }

        $this->container[$offset] = $value;
    }

    public function offsetExists($offset) {
        return isset($this->container[$offset]);
    }

    public function offsetUnset($offset) {
        unset($this->container[$offset]);
    }

    public function offsetGet($offset) {
        return isset($this->container[$offset]) ? $this->container[$offset] : null;
    }
    //
}

$obj = new AccessClass(489769878);
//odczyt 
print_r($obj[4]);
echo '<br>';
//zapis
$obj[4] = 0;
//odczyt
print_r($obj[4]);
echo '<br>';
print_r($obj);

?>