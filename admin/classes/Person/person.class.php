<?php

namespace Person;

class Person {
  //Properties
  public $name;
  private $eyeColor;
  private $age;

  public function __construct($name, $eyeColor, $age){
    $this->name = $name;
    $this->eyeColor = $eyeColor;
    $this->age = $age;
  }

  public static $drinkingAge = 21;

  //Methods
  public function setName(string $name) {
    $this->name = $name;
  }

  public function getDA(){
    return self::$drinkingAge;
  }

  public static function setdrinkingAge($newDA) {
    self::$drinkingAge = $newDA;
  }



}


 ?>
