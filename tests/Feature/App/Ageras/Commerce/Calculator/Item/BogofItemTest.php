<?php

namespace Tests\Feature\App\Ageras\Commerce\Calculator\Item;

use App\Ageras\Commerce\Basket;
use App\Ageras\Commerce\Item\BogofItem;
use App\Ageras\Commerce\Item\SimpleItem;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BogofItemTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testAddToBasket()
    {
        $bogofItem = new BogofItem('bogof name', 10);
        $basket = $this->getMockBuilder(Basket::class)->getMock();

        $basket->expects($this->once())
            ->method('addItem')
            ->with($this->isInstanceOf(SimpleItem::class));

        $bogofItem->addToBasket($basket);
        $this->assertInstanceOf(SimpleItem::class, $bogofItem->getChildItem());
        $this->assertEquals(0, $bogofItem->getChildItem()->getPrice());
        $this->assertEquals('bogof name', $bogofItem->getChildItem()->getName());

    }

    public function testRemoveFromBasket()
    {

        $bogofItem = new BogofItem('bogof name', 10);
        $bogofItem->setChildItem(new SimpleItem($bogofItem->getName(), 0));

        $basket = $this->getMockBuilder(Basket::class)->getMock();

        $basket->expects($this->exactly(1))
            ->method('removeItem')
            ->with($this->equalTo($bogofItem->getChildItem()));

        $bogofItem->removeFromBasket($basket);
    }
}
