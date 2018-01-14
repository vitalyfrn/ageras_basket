<?php

namespace App\Ageras\Commerce;


trait BasketAwareTrait
{
    /**
     * @var Basket;
     */
    protected $basket;


    public function setBasket(Basket $basket = null): self
    {
        $this->basket = $basket;

        return $this;
    }

    /**
     * @return Basket
     */
    public function getBasket(): Basket
    {
        return $this->basket;
    }

}