<?php

use classes\Cart;
use classes\Customer;
use classes\Item;

$customerExample = [
    'id'  => 1,
    'first_name'  => 'Alan',
    'last_name'   => 'Martin',
    'address' => array (
        array (
            'address_1' => '15 h',
            'address_2' => 'Baker st.',
            'city' => 'London',
            'state' => 'UK',
            'zip' => 132,
        ),
    ),
];
$itemsExample = [
    [
        'id' => 1,
        'name' => 'tablet',
        'quantity' => 10,
        'price' => 100.99
    ],
    [
        'id' => 2,
        'name' => 'phone',
        'quantity' => 2,
        'price' => 59.99
    ],
    [
        'id' => 3,
        'name' => 'car',
        'quantity' => 1,
        'price' => 9999
    ],
];

$customer = new Customer($customerExample);
$cart = new Cart($customer);

foreach ($itemsExample as $item) {
    $item = new Item($item);
    $cart->setItem($item);
}
