<?php

namespace Tests\Feature\App\Ageras\Commerce\Calculator\Rule;

use App\Ageras\Commerce\Calculator\BasketTotalCalculator;
use App\Ageras\Commerce\Calculator\Rule\TenPercentOffWithThresholdRule;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TenPercentOffRuleTest extends TestCase
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

        $rule = new TenPercentOffWithThresholdRule();

        $rule->apply($calculator);
        $this->assertTrue(true);

    }

    public function ruleDataProvider()
    {
        return [
            [100, 90],
            [10, 10]
        ];

    }
}
