<?php

namespace Investor;

use Investment\InsufficientBalanceOnTranche;
use Money\Money;

class Wallet
{
    /**
     * @var Money
     */
    private $balance;

    /**
     * DigitalWallet constructor.
     *
     * @param Money $balance
     */
    public function __construct(Money $balance)
    {
        $this->balance = $balance;
    }

    /**
     * @param Money $amount
     *
     * @throws InsufficientBalanceOnTranche
     */
    public function invest(Money $amount)
    {
        if ($this->balance->lessThan($amount)) {
            throw new InsufficientBalanceOnTranche($this->balance, $amount);
        }

        $this->balance = $this->balance->subtract($amount);
    }

    /**
     * @return Money
     */
    public function getBalance(): Money
    {
        return $this->balance;
    }
}
