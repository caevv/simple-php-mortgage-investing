<?php

namespace Investment;

use Investor\Investor;
use Money\Money;

class Invest
{
    /**
     * @var Investor
     */
    private $investor;

    /**
     * Invest constructor.
     *
     * @param Investor $investor
     */
    public function __construct(Investor $investor)
    {
        $this->investor = $investor;
    }

    /**
     * @param Money              $amount
     * @param Tranche            $tranche
     * @param \DateTimeImmutable $date
     *
     * @return Investment
     */
    public function invest(Money $amount, Tranche $tranche, \DateTimeImmutable $date): Investment
    {
        return new Investment($this->investor, $date, $tranche, $amount);
    }
}
