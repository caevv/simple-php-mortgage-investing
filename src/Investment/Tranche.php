<?php

namespace Investment;

use Money\Money;

class Tranche
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var int
     */
    private $interest;

    /**
     * @var Money
     */
    private $amountAvailable;

    /**
     * @param string $name
     * @param int    $interest
     * @param Money  $amountAvailable
     */
    public function __construct(string $name, int $interest, Money $amountAvailable)
    {
        $this->name = $name;
        $this->interest = $interest;
        $this->amountAvailable = $amountAvailable;
    }

    /**
     * @param Money $amount
     *
     * @throws InsufficientBalance
     */
    public function invest(Money $amount)
    {
        if ($this->amountAvailable->lessThan($amount)) {
            throw new InsufficientBalance($this->name, $this->amountAvailable, $amount);
        }

        $this->amountAvailable = $this->amountAvailable->subtract($amount);
    }

    /**
     * @return int
     */
    public function getInterest(): int
    {
        return $this->interest;
    }
}
