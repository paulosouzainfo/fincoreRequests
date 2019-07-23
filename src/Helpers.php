<?php
namespace Fincore;

class Helpers
{
    public function __construct()
    {}

    public static function println($textArrayOrObject, bool $dump = false): void
    {
        if ($dump) {
            print_r($textArrayOrObject) . PHP_EOL;
        } else {
            echo $textArrayOrObject . PHP_EOL;
        }

    }

    public static function parseStr(string $string): array
    {
        preg_match_all('/[=&]/', $string, $matches);

        $data = [];
        if (!empty(array_shift($matches))) {
            parse_str($string, $data);
        }

        return $data;
    }

    public static function buildQuery(array $data): string
    {
        return urldecode(http_build_query($data));
    }

    public static function File(array $data): string
    {
        return urldecode(http_build_query($data));
    }

    public static function Filexlsx(string $header, string $content)
    {
        preg_match('/([A-Za-z0-9]+)\.xlsx$/', $header, $output);
        $dirpath = substr($output[0], 0, 3) . '/' . substr($output[0], 3, 3);
        is_dir($dirpath) || mkdir($dirpath, 0755, true);
        file_put_contents($dirpath . '/' . substr($output[0], 6), $content);
        return ('File criado com sucesso em ' . $dirpath . '/' . substr($output[0], 6));

    }

}
