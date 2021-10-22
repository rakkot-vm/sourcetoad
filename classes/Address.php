<?php


namespace classes;

/**
 * Class Address
 * the main purpose of this class is to show that in any place in sustem
 * if we need to use address we absolutely sure how "address" looks like
 * @package classes
 */
class Address
{
    public string $address_1;
    public string $address_2;
    public string $city;
    public string $state;
    public string $zip;

    public function __construct(array $addressArr)
    {
        foreach ($addressArr as $key => $value) {
            $this->$key = $value;
        }
    }
}
