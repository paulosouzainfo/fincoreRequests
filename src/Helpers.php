<?php
namespace Fincore;

class Helpers {
  public function __construct() {}

  public static function println($textArrayOrObject, bool $dump = false): void {
    if($dump) print_r($textArrayOrObject).PHP_EOL;
    else echo $textArrayOrObject.PHP_EOL;
  }

  public static function parseStr(string $string): array {
    preg_match_all('/[=&]/', $string, $matches);

    $data = [];
    if(!empty(array_shift($matches))) parse_str($string, $data);

    return $data;
  }

  public static function buildQuery(array $data): string {
    return urldecode(http_build_query($data));
  }
}
