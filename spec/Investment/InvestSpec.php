<?php

namespace spec\Investment;

use Investment\Investment;
use Investment\Tranche;
use Investor\Investor;
use Investor\Wallet;
use Money\Money;
use PhpSpec\ObjectBehavior;

class InvestSpec extends ObjectBehavior
{
    function it_invest_on_tranche()
    {
        $investor = new Investor('a', new Wallet(Money::GBP(10)));
        $tranche = new Tranche('a', 5, Money::GBP(10));

        $this->beConstructedWith($investor);

        $amount = Money::GBP(1);
        $date = new \DateTimeImmutable();
        $this->invest($amount, $tranche, $date)->beAnInstanceOf(Investment::class);
    }
}
