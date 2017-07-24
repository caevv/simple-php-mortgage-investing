<?php

namespace Investment;

use Money\Currencies\ISOCurrencies;
use Money\Formatter\DecimalMoneyFormatter;
use Money\Money;

class InsufficientBalanceOnTranche extends \InvalidArgumentException
{
    const MESSAGE = "Error: Tranche %s has insufficient balance. Available %s, attempt %s";

    /**
     * @param string $trancheName
     * @param Money  $amountAvailable
     * @param Money  $amount
     */
    public function __construct(string $trancheName, Money $amountAvailable, Money $amount)
    {
        $decimalMoneyFormatter = new DecimalMoneyFormatter(new ISOCurrencies());

        $message = sprintf(
            static::MESSAGE,
            $trancheName,
            $decimalMoneyFormatter->format($amountAvailable),
            $decimalMoneyFormatter->format($amount)
        );

        parent::__construct($message);
    }
}
