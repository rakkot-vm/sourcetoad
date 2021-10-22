<?php


namespace traits;

use classes\Address;

/**
 * Trait Shipping
 * just some imitation of shipping class
 * @package classes
 */
trait Shipping
{

    /**
     * @param string $shipping_address
     * @param array $someImportantData - could receive some data like size or weight of goods
     * @return float
     */
    protected function calcShipping(Address $shipping_address, array $someImportantData = []): float
    {
        return mt_rand(1, 100);
    }
}
