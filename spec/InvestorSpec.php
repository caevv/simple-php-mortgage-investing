<?php

namespace spec;

use Investor;
use Money\Money;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Tranche;
use Wallet;

/**
 */
class InvestorSpec extends ObjectBehavior
{
    function it_have_balance()
    {
        $balance = Money::GBP(100000);

        $this->beConstructedWith('name', new Wallet($balance));

        $this->getBalance()->shouldReturn($balance);
    }
}
