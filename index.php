<?php
class AccessClass implements ArrayAccess {
    private $container = [];

    public function __construct() {
        for($i = 1; $i <= 32; $i++){
            $this->container[$i] = $i;
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

$obj = new AccessClass();
//odczyt 
print_r($obj[15]);
//zapis
$obj[15] = 33;
//odczyt
print_r($obj[15]);
//wyświetlenie wszystkich wartości z tablicy
for($i = 1; $i <= 32; $i++){
    echo $i .' => '.$obj[$i].'<br>';
}

?>