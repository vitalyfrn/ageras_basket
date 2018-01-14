<?php

namespace Tests\Feature\App\Ageras\Commerce\Calculator;


use App\Ageras\Commerce\Basket;
use App\Ageras\Commerce\Calculator\BasketTotalCalculator;
use App\Ageras\Commerce\Calculator\Rule\TenPercentOffWithThresholdRule;
use App\Ageras\Commerce\Calculator\Rule\TwoPercentOffRule;
use App\Ageras\Commerce\Item\BogofItem;
use App\Ageras\Commerce\Item\SimpleItem;
use Tests\TestCase;

class BasketTotalCalculatorTest extends TestCase
{

    public function testRules()
    {

        $basket = new Basket();

        $calculator = new BasketTotalCalculator($basket);

        $basket->addItem(new SimpleItem('simple item 1', 10));
        $basket->addItem(new SimpleItem('simple item 1', 20));

        $calculator
            ->addRule(new TenPercentOffWithThresholdRule())
            ->addRule(new TwoPercentOffRule());

        $this->assertInstanceOf(Basket::class, $calculator->getBasket());

        $calculator->applyRules();

        $this->assertEquals(30 * 0.9 *0.98, $calculator->getTotal());



    }
    public function testRulesWithBogof()
    {

        $basket = new Basket();

        $calculator = new BasketTotalCalculator($basket);

        $basket->addItem(new SimpleItem('simple item 1', 10));
        $basket->addItem(new SimpleItem('simple item 1', 20));
        $basket->addItem(new BogofItem('bogof item 1', 30));

        $calculator
            ->addRule(new TenPercentOffWithThresholdRule())
            ->addRule(new TwoPercentOffRule());

        $this->assertInstanceOf(Basket::class, $calculator->getBasket());

        $calculator->applyRules();

        $this->assertEquals(60 * 0.9 *0.98, $calculator->getTotal());
        $this->assertEquals(4, $basket->getItemCount());



    }
}
