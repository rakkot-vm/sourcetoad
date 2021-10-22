<?php


namespace classes;


class Item
{
    protected int $id;
    protected string $name;
    protected int $quantity;
    protected float $price;

    public function __construct(array $item)
    {
        foreach ($item as $key => $value){
            $this->$key = $value;
        }
    }

    public function __get($name)
    {
        return $this->$name;
    }
}
