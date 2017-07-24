<?php

namespace spec\Investment;

use Investment\Invest;
use Investment\Investment;
use Investment\Tranche;
use Investor\Investor;
use Money\Money;
use PhpSpec\ObjectBehavior;

/**
 * @mixin Invest
 */
class InvestSpec extends ObjectBehavior
{
    function it_invest_on_tranche(Investor $investor, Tranche $tranche)
    {
        $this->beConstructedWith($investor);

        $amount = Money::GBP(1);
        $date = new \DateTimeImmutable();

        $this->invest($amount, $tranche, $date)->beAnInstanceOf(Investment::class);

        $tranche->invest($amount)->shouldBeCalled();
        $investor->invest($amount)->shouldBeCalled();
    }
}
