<?php

namespace spec\Investor;

use Investor;
use Investor\Wallet;
use Money\Money;
use PhpSpec\ObjectBehavior;

/**
 * @mixin Investor\Investor
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
