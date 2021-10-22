<?php

namespace classes;

use interfaces\CustomerInterface;

class Customer implements CustomerInterface
{
    protected int $id;
    protected string $first_name;
    protected string $last_name;
    protected array $addresses;

    public function __construct(array $customerArray)
    {
        $this->id = $customerArray['id'];
        $this->first_name = $customerArray['first_name'];
        $this->last_name = $customerArray['last_name'];

        $this->addresses = [];
        $this->setAddresses($customerArray['address']);
    }

    public function getShippingAddress(): Address
    {
        if($this->addresses['shipping']) {
            return $this->addresses['shipping'];
        } else {
            return $this->addresses[array_key_first($this->addresses)];
        }
    }

    public function getAddresses(): array
    {
        return $this->addresses;
    }

    public function getName(): string
    {
        return $this->first_name .' '. $this->last_name;
    }

    private function setAddresses(array $addressesArr)
    {
        $this->addresses = is_array($this->addresses) ? $this->addresses : [] ;

        foreach ($addressesArr as $key => $value){
            if($key == 'shipping'){
                $this->addresses['shipping'] = new Address($value);
            } else {
                $this->addresses[] = new Address($value);
            }
        }
    }
}
