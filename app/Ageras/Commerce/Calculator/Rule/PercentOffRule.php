<?php

namespace App\Ageras\Commerce\Calculator\Rule;

use App\Ageras\Commerce\Calculator\BasketTotalCalculator;

class PercentOffRule extends CalculatorRuleAbstract
{
    /**
     * @var int
     */
    protected $percent;

    /**
     * @return mixed
     */
    public function getPercent()
    {
        return $this->percent;
    }

    /**
     * @param mixed $percent
     * @return PercentOffRule
     */
    public function setPercent($percent)
    {
        $this->percent = $percent;
        return $this;
    }

    public function apply(BasketTotalCalculator $calculator)
    {
        $calculator->setTotal($this->calculateTotal($calculator->getTotal()));
    }

    protected function calculateTotal(float $total): float
    {
        if (!empty($this->getPercent())) {
            $total = $total - ($total * $this->getPercent() * 0.01);
        }
        return $total;
    }

}