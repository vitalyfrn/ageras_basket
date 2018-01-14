<?php

namespace App\Ageras\Commerce\Calculator\Rule;

use App\Ageras\Commerce\Calculator\BasketTotalCalculator;

class TwoPercentOffRule extends PercentOffRule
{
    const PERCENT = 2;

    public function apply(BasketTotalCalculator $calculator)
    {
        $this->setPercent(self::PERCENT);
        parent::apply($calculator);
    }
}