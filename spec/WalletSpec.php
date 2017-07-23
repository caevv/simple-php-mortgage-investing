<?php

namespace spec;

use Money\Money;
use PhpSpec\ObjectBehavior;

class WalletSpec extends ObjectBehavior
{
    function it_returns_balance()
    {
        $balance = Money::GBP(100000);

        $this->beConstructedWith($balance);

        $this->getBalance()->shouldReturn($balance);
    }
}
