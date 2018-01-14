<?php

namespace Tests\Feature\App\Ageras\Commerce;

use App\Ageras\Commerce\Calculator\BasketTotalCalculator;
use App\Ageras\Commerce\Calculator\Rule\TenPercentOffWithThresholdRule;
use App\Ageras\Commerce\Calculator\Rule\TwoPercentOffRule;
use App\Ageras\Commerce\Item\BogofItem;
use App\Ageras\Commerce\Item\SimpleItem;
use App\Ageras\Commerce\Basket;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BasketTest extends TestCase
{


    public function testCanAddItem()
    {
        $basket = new Basket();

        $basket->addItem(new SimpleItem());

        $this->assertEquals(1, $basket->getItemCount());
    }

    public function testCanRemoveItem()
    {
        $basket = new Basket();

        $item = new SimpleItem();
        $item2 = new BogofItem();


        $basket->addItem($item);
        $basket->addItem($item2);


        $this->assertTrue($basket->removeItem($item2));


        $this->assertEquals(1, $basket->getItemCount());
    }

    public function testCannotRemoveItem()
    {
        $basket = new Basket();

        $item = new SimpleItem();
        $item2 = new SimpleItem();


        $basket->addItem($item);
        $basket->addItem($item2);

        $this->assertTrue($basket->removeItem($item));
        $this->assertFalse($basket->removeItem($item));
        $this->assertEquals(1, $basket->getItemCount());
    }

    public function testCanRemoveAll()
    {
        $basket = new Basket();

        $item = new SimpleItem();
        $item2 = new SimpleItem();


        $basket->addItem($item);
        $basket->addItem($item2);

        $basket->removeAll();
        $this->assertEquals(0, $basket->getItemCount());

    }

    public function testGetTotal()
    {
        $basket = $this->getBasketWithRules();


        $basket->addItem(new SimpleItem('simple item 1', 10));
        $basket->addItem(new SimpleItem('simple item 1', 20));
        $basket->addItem(new BogofItem('bogof item 1', 30));

        $this->assertEquals(60 * 0.9 * 0.98, $basket->getTotal());
        $this->assertEquals(4, $basket->getItemCount());
    }

    public function testGetTotalWithManipulation()
    {

        $basket = $this->getBasketWithRules();

        $bogofItem = new BogofItem('bogof item 1', 30);

        $basket->addItem(new SimpleItem('simple item 1', 10));
        $basket->addItem(new SimpleItem('simple item 1', 20));
        $basket->addItem($bogofItem);
        $basket->removeItem($bogofItem);

        $this->assertEquals(30 * 0.9 * 0.98, $basket->getTotal());
        $this->assertEquals(2, $basket->getItemCount());
    }

    protected function getBasketWithRules()
    {
        $basket = new Basket();
        $calculator = new BasketTotalCalculator();

        $isLoyaltyCardCustomer = true;

        $calculator->addRule(new TenPercentOffWithThresholdRule());
        if ($isLoyaltyCardCustomer) {
            $calculator->addRule(new TwoPercentOffRule());
        }

        $basket->setCalculator($calculator);

        return $basket;
    }
}
