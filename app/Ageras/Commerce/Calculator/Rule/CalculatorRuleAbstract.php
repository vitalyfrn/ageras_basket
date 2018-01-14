<?php
namespace App\Ageras\Commerce\Calculator\Rule;

use App\Ageras\Commerce\Calculator\BasketTotalCalculator;

abstract class CalculatorRuleAbstract
{

    abstract public function apply(BasketTotalCalculator $basket);

}