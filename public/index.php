<?php

use adapters\CartWebAdapter;

spl_autoload_register(function ($class) {
    $class = str_replace('\\', '/', $class);

    require_once '../'.$class . '.php';
});

require "../fill_cart.php";

$adapter = new CartWebAdapter($cart);

$adapter->customerName();
echo '<br>';
$adapter->shippingAddress();
echo '<br>';
$adapter->customerAddresses();
echo '<br>';
$adapter->itemCost();
echo '<br>';
$adapter->cartItems();
echo '<br>';
$adapter->subtotal();
echo '<br>';
$adapter->total();
