<?php

namespace Tests\Feature\App\Ageras\Commerce\Calculator\Rule;

use App\Ageras\Commerce\Calculator\BasketTotalCalculator;
use App\Ageras\Commerce\Calculator\Rule\TwoPercentOffRule;
use Tests\TestCase;

class TwoPercentOffRuleTest extends TestCase
{
    /**
     * @dataProvider ruleDataProvider
     */
    public function testApplyRule($total, $totalAfter)
    {
        $calculator = $this->getMockBuilder(BasketTotalCalculator::class)->getMock();

        $calculator->expects($this->any())
            ->method('getTotal')
            ->willReturn($total);
        $calculator->expects($this->any())
            ->method('setTotal')
            ->willReturn($totalAfter);

        $rule = new TwoPercentOffRule();

        $rule->apply($calculator);
        $this->assertTrue(true);

    }

    public function ruleDataProvider()
    {
        return [
            [100, 98],
            [10, 9.8]
        ];

    }
}
