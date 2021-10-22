<?php
namespace interfaces;

use classes\Address;

interface CustomerInterface
{
    public function getShippingAddress(): Address;
}
