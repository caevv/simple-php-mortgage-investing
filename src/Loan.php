<?php

class Loan
{
    /**
     * @var array|Tranche[]
     */
    private $tranches;

    /**
     * @var DateTimeImmutable
     */
    private $startDate;

    /**
     * @var DateTimeImmutable
     */
    private $endDate;

    /**
     * @param Tranche[] $tranches
     * @param DateTimeImmutable $startDate
     * @param DateTimeImmutable $endDate
     */
    public function __construct(array $tranches, DateTimeImmutable $startDate, DateTimeImmutable $endDate)
    {
        $this->tranches = $tranches;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }
}
