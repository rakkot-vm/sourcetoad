<?php


namespace traits;


trait Taxes
{
    private float $defaultTax = 7;

    /**
     * Returns tax percent
     * @return float
     */
    public function getTax(): float
    {
        return $this->defaultTax;
    }

    public function getTaxAmount(float $amount): float
    {
        if($amount) {
            return $amount / 100 * $this->getTax();
        } else {
            return 0;
        }
    }
}
