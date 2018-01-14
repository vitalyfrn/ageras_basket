<?php

namespace App\Ageras\Commerce;

use App\Ageras\Commerce\Calculator\BasketTotalCalculator;
use App\Ageras\Commerce\Item\ItemAbstract;


class Basket
{
    /**
     * @var ItemAbstract[]
     */
    private $items;

    /**
     * @var BasketTotalCalculator
     */
    private $calculator;

    /**
     * @return BasketTotalCalculator
     */
    public function getCalculator(): BasketTotalCalculator
    {
        return $this->calculator;
    }

    /**
     * @param BasketTotalCalculator $calculator
     * @return Basket
     */
    public function setCalculator(BasketTotalCalculator $calculator = null): Basket
    {
        $this->calculator = $calculator;
        if (!is_null($calculator)) {
            $this->calculator->setBasket($this);
        }
        return $this;
    }

    /**
     * @param ItemAbstract $item
     */
    public function addItem(ItemAbstract $item): void
    {
        $this->items[] = $item;
        $item->addToBasket($this);
    }

    /**
     * @param ItemAbstract $item
     * @return bool
     */
    public function removeItem(ItemAbstract $item): bool
    {
        $item->removeFromBasket($this);

        if (false !== ($index = array_search($item, $this->items, true))) {

            unset($this->items[$index]);
            return true;
        }

        return false;
    }

    /**
     *
     */
    public function removeAll(): void
    {
        $this->items = [];
    }

    /**
     * @return int
     */
    public function getItemCount(): int
    {
        return count($this->getItems());
    }

    /**
     * @return ItemAbstract[]
     */
    public function getItems()
    {
        return $this->items;
    }

    public function getTotal()
    {
        return $this->getCalculator()->applyRules()->getTotal();
    }
}