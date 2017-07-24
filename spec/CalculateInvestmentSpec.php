<?php

namespace spec;

use Investment;
use Investor;
use Money\Money;
use PhpSpec\ObjectBehavior;
use Tranche;
use Wallet;

class CalculateInvestmentSpec extends ObjectBehavior
{
    function it_calculates_for_period()
    {
        $investor = new Investor('1', new Wallet(Money::GBP(100000)));
        $tranche = new Tranche('A', 3, Money::GBP(100000));

        $endDate = new \DateTimeImmutable('2015-10-31');
        $investment = new Investment($investor, new \DateTimeImmutable('2015-10-03'), $tranche, Money::GBP(100000));

        $this->beConstructedWith([$investment]);

        $this->calculate($endDate)->shouldBeLike([$investment->getId()->toString() => Money::GBP(2806)]);
    }
}
