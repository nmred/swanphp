<?php
require_once 'vendor/autoload.php';

$str = '  dsds|    dddd      |    ddddd |   ';
$arr = explode('|', $str);

$rev = \Swan\Stdlib\Trim::trimArray($arr, true);
var_dump($rev);
