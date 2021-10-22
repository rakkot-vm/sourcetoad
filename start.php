<?php

use classes\NestedArraysOutput;

spl_autoload_register(function ($class) {
    $class = str_replace('\\', '/', $class);

    require_once $class . '.php';
});

include 'example_array.php';

echo 'Please choose the task : ' . PHP_EOL;
echo '1 - output nested arrays( task 1)' . PHP_EOL;
echo '2 - output sorted nested arrays (task 2) (sorted high level items by "account_id" and "last_name")' . PHP_EOL;

$userInput = readline('');
$answers = ['1' => 'auto', '0' => 'manual'];

switch ($userInput) {
    case '1':
        $nestedArrs = new NestedArraysOutput($exampleArray);
        $nestedArrs->print();
        break;
    case '2':
        $nestedArrs = new NestedArraysOutput($exampleArray);
        $nestedArrs->sortByKeys();
        $nestedArrs->print();
        break;
}
