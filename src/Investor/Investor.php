<?php

namespace Investor;

use Investment\InsufficientBalanceOnTranche;
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
     * @param Money $amount
     *
     * @throws InsufficientBalanceOnTranche
     */
    public function invest(Money $amount)
    {
        $this->wallet->invest($amount);
    }

    /**
     * @return Money
     */
    public function getBalance(): Money
    {
        return $this->wallet->getBalance();
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}
