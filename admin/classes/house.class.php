  <?php

class NewClass {
  //Properties and methods goes here
  public $data = "I am a property";

  public function __construct(){
    echo "This class has been instantiated <br>";
  }

  public function setNewProperty($newdata) {
    $this->data = $newdata;

  }

  public function getProperty() {
    return $this->data;
  }

  public function __destruct() {
    echo "<br> This is the end of the class!";
  }
}
/**
 *
 */
// class Person {
//
//   protected $first = "Daniel";
//   public $last = "Nielsen";
//   private $age = "28";
//
//
//
// }
//
// class Pet extends Person {
//   public function owner() {
//     $a = $this->last;
//     return $a;
//   }
// }
