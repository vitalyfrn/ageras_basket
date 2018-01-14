<?php

namespace App\Ageras\Commerce\Calculator;


use App\Ageras\Commerce\BasketAwareTrait;
use App\Ageras\Commerce\Calculator\Rule\CalculatorRuleAbstract;
use App\Ageras\Commerce\Basket;


class BasketTotalCalculator
{
    use BasketAwareTrait;

    /**
     * @var CalculatorRuleAbstract[]
     */
    protected $rules;
    /**
     * @var float
     */
    protected $total;


    public function __construct(Basket $basket = null)
    {
        $this->setBasket($basket);
    }

    public function addRule(CalculatorRuleAbstract $rule): BasketTotalCalculator
    {
        $this->rules[] = $rule;
        return $this;
    }

    public function applyRules() : BasketTotalCalculator
    {
        foreach ($this->getBasket()->getItems() as $item)
        {
            $this->total += $item->getPrice();
        }

        foreach ($this->rules as $rule) {
            $rule->apply($this);
        }

        return $this;
    }

    public function setTotal($total)
    {
        $this->total = $total;
    }

    public function getTotal()
    {
        return $this->total;

    }
}