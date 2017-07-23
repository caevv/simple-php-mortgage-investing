<?php

use Money\Money;

class Investor
{
    /**
     * @var Wallet
     */
    private $wallet;

    /**
     * @var string
     */
    private $name;

    /**
     * @param string $name
     * @param Wallet $wallet
     */
    public function __construct(string $name, Wallet $wallet)
    {
        $this->wallet = $wallet;
        $this->name = $name;
    }

    /**
     * @return Money
     */
    public function getBalance(): Money
    {
        return $this->wallet->getBalance();
    }
}
