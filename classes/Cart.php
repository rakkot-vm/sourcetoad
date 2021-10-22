<?php

namespace classes;


use traits\Shipping;
use traits\Taxes;

class Cart
{
    use Taxes, Shipping;

    private Customer $customer;
    private array $items;
    private Address $shipping_address;
    private float $subtotal;
    private float $shipping_cost;
    private float $tax_amount;
    private float $total;

    public function __construct(Customer $customer)
    {
        $this->setCustomer($customer);

        $this->tax_amount = 0;
        $this->shipping_cost = 0;
        $this->subtotal = 0;
        $this->total = 0;
    }

    public function setItem(Item $item)
    {
        // here can be some check if there already is the same item - it should not be set but only increase quantity
        $this->items[] = $item;

        $this->recalcCart();
    }

    /**
     * @return array of Item
     */
    public function getItems(): array
    {
        return $this->items;
    }

    public function getItemCost($item_key): array
    {
        $item_subtotal = $this->items[$item_key]->price * $this->items[$item_key]->quantity;
        $item_tax = $this->getTaxAmount($item_subtotal);

        return [
            'item' => $this->items[$item_key],
            'shipping' => $this->shipping_cost,
            'tax' => $item_tax,
            'subtotal' => $item_subtotal,
            'total' => $item_tax + $this->shipping_cost + $item_subtotal
        ];
    }

    public function getAmount(): array
    {
        return $this->items;
    }

    public function getCartTotal(): float
    {
        return $this->total;
    }

    public function getCartSubTotal(): float
    {
        return $this->subtotal;
    }

    public function getShippingAddress(): Address
    {
        return $this->shipping_address;
    }

    public function setCustomer(Customer $customer)
    {
        $this->customer = $customer;
        $this->setShippingAddress($customer->getShippingAddress());
    }

    public function getCustomer(): Customer
    {
        return $this->customer;
    }

    private function setShippingAddress(Address $ship_address)
    {
        $this->shipping_address = $ship_address;

        $this->shipping_cost = $this->calcShipping($this->shipping_address);
    }

    private function recalcCart()
    {
        foreach ($this->items as $itemKey => $item){
            $this->subtotal += $item->price * $item->quantity;
        }

        $this->shipping_cost = $this->calcShipping($this->shipping_address);
        $this->tax_amount = $this->getTaxAmount($this->subtotal) ;
        $this->total = $this->tax_amount + $this->shipping_cost;
    }
}
