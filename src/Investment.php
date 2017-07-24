<?php

use Money\Money;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class Investment
{
    /**
     * @var Investor
     */
    private $investor;
    /**
     * @var DateTimeImmutable
     */
    private $date;
    /**
     * @var Tranche
     */
    private $tranche;
    /**
     * @var Money
     */
    private $amount;

    /**
     * @var UuidInterface
     */
    private $id;

    /**
     * Investment constructor.
     * @param Investor $investor
     * @param DateTimeImmutable $date
     * @param Tranche $tranche
     * @param Money $amount
     */
    public function __construct(Investor $investor, DateTimeImmutable $date, Tranche $tranche, Money $amount)
    {
        $this->id = Uuid::uuid4();

        $this->investor = $investor;
        $this->date = $date;
        $this->tranche = $tranche;
        $this->amount = $amount;
    }

    /**
     * @return Tranche
     */
    public function getTranche(): Tranche
    {
        return $this->tranche;
    }

    /**
     * @return Investor
     */
    public function getInvestor(): Investor
    {
        return $this->investor;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getDate(): DateTimeImmutable
    {
        return $this->date;
    }

    /**
     * @return Money
     */
    public function getAmount(): Money
    {
        return $this->amount;
    }

    /**
     * @return UuidInterface
     */
    public function getId(): UuidInterface
    {
        return $this->id;
    }
}