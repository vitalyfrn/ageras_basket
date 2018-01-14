<?php

namespace App\Ageras\Commerce\Item;


use App\Ageras\Commerce\Basket;

class BogofItem extends ItemAbstract
{
    /**
     * @var ItemAbstract
     */
    private $childItem;

    /**
     * @return ItemAbstract
     */
    public function getChildItem(): ?ItemAbstract
    {
        return $this->childItem;
    }

    /**
     * @param ItemAbstract $childItem
     * @return BogofItem
     */
    public function setChildItem(ItemAbstract $childItem = null): BogofItem
    {
        $this->childItem = $childItem;

        return $this;
    }

    public function removeFromBasket(Basket $basket)
    {
        if ($this->getChildItem()) {
            $basket->removeItem($this->getChildItem());
        }
    }


    public function addToBasket(Basket $basket)
    {
        $childItem = new SimpleItem($this->getName(), 0);
        $this->setChildItem($childItem);
        $basket->addItem($childItem);
    }
}