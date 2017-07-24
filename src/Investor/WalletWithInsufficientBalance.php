<?php

namespace Investment;

use Money\Currencies\ISOCurrencies;
use Money\Formatter\DecimalMoneyFormatter;
use Money\Money;

class WalletWithInsufficientBalance extends \InvalidArgumentException
{
    const MESSAGE = "Error: Wallet has insufficient balance. Available %s, attempt %s";

    /**
     * @param Money $amountAvailable
     * @param Money $amount
     */
    public function __construct(Money $amountAvailable, Money $amount)
    {
        $decimalMoneyFormatter = new DecimalMoneyFormatter(new ISOCurrencies());

        $message = sprintf(
            static::MESSAGE,
            $decimalMoneyFormatter->format($amountAvailable),
            $decimalMoneyFormatter->format($amount)
        );

        parent::__construct($message);
    }
}
