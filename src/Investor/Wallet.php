<?php

namespace Investor;

use Investment\WalletWithInsufficientBalance;
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
     * @throws WalletWithInsufficientBalance
     */
    public function invest(Money $amount)
    {
        if ($this->balance->lessThan($amount)) {
            throw new WalletWithInsufficientBalance($this->balance, $amount);
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
