<?php

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
     * @param int $interest
     * @param Money $amountAvailable
     */
    public function __construct(string $name, int $interest, Money $amountAvailable)
    {
        $this->name = $name;
        $this->interest = $interest;
        $this->amountAvailable = $amountAvailable;
    }
}