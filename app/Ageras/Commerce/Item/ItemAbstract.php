<?php

namespace App\Ageras\Commerce\Item;


use App\Ageras\Commerce\Basket;

abstract class ItemAbstract
{
    /**
     * @var float
     */
    protected $price;

    /**
     * @var string
     */
    protected $name;

   /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return ItemAbstract
     */
    public function setName(string $name): ItemAbstract
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $price
     * @return ItemAbstract
     */
    public function setPrice(float $price): ItemAbstract
    {
        $this->price = $price;
        return $this;
    }

    public function __construct($name = '', $price = 0)
    {
        $this->setName($name);
        $this->setPrice($price);
    }

    abstract public function removeFromBasket(Basket $basket);
    abstract public function addToBasket(Basket $basket);


}