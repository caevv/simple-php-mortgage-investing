<?php

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
     * @return Money
     */
    public function getBalance(): Money
    {
        return $this->balance;
    }
}
