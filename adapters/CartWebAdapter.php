<?php

namespace adapters;

use classes\Cart;

/* //TODO this class should implement adapter interface!!! */
class CartWebAdapter
{
    protected Cart $cart;

    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
    }

    public function customerName()
    {
        echo $this->cart->getCustomer()->getName();
    }

    public function customerAddresses()
    {
        $addresses = $this->cart->getCustomer()->getAddresses();

        foreach ($addresses as $address) {
            print_r((array) $address);
        }
    }

    public function shippingAddress()
    {
        print_r((array) $this->cart->getShippingAddress());
    }

    public function cartItems()
    {
        $items = $this->cart->getItems();

        foreach ($items as $item) {
            echo '<br>';
            print_r((array) $item);
        }
    }

    public function itemCost()
    {
        if ($_REQUEST['item']) {
            // here should be validation...
            echo $this->cart->getItemCost($_REQUEST['item'])['total'];
        } else {
            // here should be some status / http response code.......
            echo 'you need to sent item key!!:)';
        }
    }

    public function subtotal()
    {
        echo $this->cart->getCartSubTotal();
    }

    public function total()
    {
        echo $this->cart->getCartTotal();
    }
}
