<?php

namespace Investment;

class Calculate
{
    /**
     * @var array
     */
    private $investments;

    /**
     * @param Investment[] $investments
     */
    public function __construct(array $investments)
    {
        $this->investments = $investments;
    }

    /**
     * @param \DateTimeImmutable $endDate
     *
     * @return array
     */
    public function calculate(\DateTimeImmutable $endDate): array
    {
        $calculatedInvestment = [];

        foreach ($this->investments as $investment) {
            $dateRange = new \DatePeriod(
                $investment->getDate()->setTime(00, 00, 00),
                (new \DateInterval('P1D')),
                $endDate->setTime(23, 59, 59)
            );

            $dailyInterest = $investment->getTranche()->getInterest() / 31;

            $interest = $dailyInterest * iterator_count($dateRange);

            $investmentId = $investment->getId()->toString();

            $calculatedInvestment[$investmentId] = $investment->getAmount()->multiply($interest / 100);
        }

        return $calculatedInvestment;
    }
}
