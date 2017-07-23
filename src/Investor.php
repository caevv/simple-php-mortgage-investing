<?php

use Money\Money;

class Investor
{
    /**
     * @var Wallet
     */
    private $wallet;

    public function __construct(Wallet $wallet)
    {
        $this->wallet = $wallet;
    }

    /**
     * @return Money
     */
    public function getBalance(): Money
    {
        return $this->wallet->getBalance();
    }
}
