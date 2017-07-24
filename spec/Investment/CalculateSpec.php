<?php

namespace spec\Investment;

use Investment\Calculate;
use Investment\Investment;
use Money\Money;
use PhpSpec\ObjectBehavior;
use Ramsey\Uuid\Uuid;
use Investment\Tranche;

/**
 * @mixin Calculate
 */
class CalculateSpec extends ObjectBehavior
{
    function it_calculates_for_period(Investment $investment, Tranche $tranche)
    {
        $endDate = new \DateTimeImmutable('2015-10-31');

        $investment->getDate()->willReturn(new \DateTimeImmutable('2015-10-03'));
        $tranche->getInterest()->willReturn(3);

        $investment->getTranche()->willReturn($tranche->getWrappedObject());
        $uuid = Uuid::uuid4();
        $investment->getId()->willReturn($uuid);
        $investment->getAmount()->willReturn(Money::GBP(100000));

        $this->beConstructedWith([$investment]);

        $this->calculate($endDate)->shouldBeLike([$uuid->toString() => Money::GBP(2806)]);
    }
}
