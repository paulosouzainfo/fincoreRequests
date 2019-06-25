<?php
namespace Fincore;

class Helpers {
  public function __construct() {}

  public static function println($textArrayOrObject, $dump = false) {
    if($dump) print_r($textArrayOrObject).PHP_EOL;
    else echo $textArrayOrObject.PHP_EOL;
  }
}
