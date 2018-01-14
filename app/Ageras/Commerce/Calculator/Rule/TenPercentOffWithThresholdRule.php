<?php

namespace App\Ageras\Commerce\Calculator\Rule;

use App\Ageras\Commerce\Calculator\BasketTotalCalculator;


class TenPercentOffWithThresholdRule extends PercentOffRule
{
    const THRESHOLD = 20;
    const PERCENT = 10;

    public function apply(BasketTotalCalculator $calculator)
    {

        $this->setPercent(self::PERCENT);
        $total = $calculator->getTotal();
        if ($total > self::THRESHOLD) {
            parent::apply($calculator);
        }
    }
}