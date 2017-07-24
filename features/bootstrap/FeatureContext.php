<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Gherkin\Node\TableNode;
use Investment\InsufficientBalance;
use Investment\Investment;
use Investment\Loan;
use Investment\Tranche;
use Investor\Investor;
use Money\Currencies\ISOCurrencies;
use Money\Money;
use Money\Parser\DecimalMoneyParser;
use PHPUnit\Framework\Assert;
use Investor\Wallet;
use Investment\Invest;
use Investment\Calculate;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context
{
    /**
     * @var Investor[]
     */
    private $investors;

    /**
     * @var Loan
     */
    private $loan;

    /**
     * @var Tranche[]
     */
    private $tranches;

    /**
     * @var Investment[]
     */
    private $investments;

    /**
     * @var array
     */
    private $interest;

    /**
     * @var Exception
     */
    private $error;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
    }

    /**
     * @Transform :amount
     *
     * @param string $money
     *
     * @return Money
     */
    public function makeMoney(string $money): Money
    {
        $money = explode(' ', $money);

        $amount = $money[0];
        $currency = $money[1];

        return (new DecimalMoneyParser(new ISOCurrencies()))->parse($amount, $currency);
    }

    /**
     * @Transform :loanBeginDate
     * @Transform :loanEndDate
     * @Transform :investDate
     * @Transform :startDate
     * @Transform :endDate
     * @Transform :date
     *
     * @param string $dateString
     *
     * @return DateTimeImmutable
     */
    public function makeDate(string $dateString): DateTimeImmutable
    {
        return DateTimeImmutable::createFromFormat('d/m/Y', $dateString);
    }

    /**
     * @Given :investor has :amount in his virtual wallet
     */
    public function hasInHisVirtualWallet(string $investorName, Money $amount)
    {
        $this->investors[$investorName] = new Investor($investorName, new Wallet($amount));
    }

    /**
     * @Given a loan starts on :loanBeginDate and ends on :loanEndDate with the following tranches:
     */
    public function aLoanStartsOnAndEndsOn(
        \DateTimeImmutable $loanBeginDate,
        \DateTimeImmutable $loanEndDate,
        TableNode $table
    ) {
        foreach ($table as $trancheData) {
            $interest = explode('%', $trancheData['Interest'])[0];
            $this->tranches[$trancheData['Name']] = new Tranche(
                $trancheData['Name'],
                $interest,
                $this->makeMoney($trancheData['Amount Available'])
            );
        }

        $this->loan = new Loan($this->tranches, $loanBeginDate, $loanEndDate);
    }

    /**
     * @Given :investor invest :amount on tranche :tranche on :investDate
     * @Given :investor invest :amount on tranche :tranche
     */
    public function investOnTrancheAOn(
        string $investor,
        Money $amount,
        string $tranche,
        DateTimeImmutable $investDate = null
    ) {
        try {
            $this->investments[$investor] = (new Invest($this->investors[$investor]))->invest(
                $amount,
                $this->tranches[$tranche],
                $investDate ? : new DateTimeImmutable()
            );
        } catch (InsufficientBalance $exception) {
            $this->error = $exception;
        }
    }

    /**
     * @When the interest is calculated for the period of :startDate to :endDate
     */
    public function theInterestsCalculatedForThePeriodOfTo(DateTimeImmutable $startDate, DateTimeImmutable $endDate)
    {
        $this->interest = (new Calculate($this->investments))->calculate($endDate);
    }

    /**
     * @Then :investor earns :amount
     */
    public function earns(string $investor, Money $amount)
    {
        Assert::assertEquals(
            $amount,
            $this->interest[$this->investments[$investor]->getId()->toString()]
        );
    }

    /**
     * @Given a loan has the following tranches:
     */
    public function aLoanHasTheFollowingTranches(TableNode $table)
    {
        throw new PendingException();
    }

    /**
     * @Given investors have already invested :amount on tranche :tranche on :date
     */
    public function investorsHaveAlreadyInvestedOnTrancheAOn(Money $amount, string $tranche, \DateTimeImmutable $date)
    {
        (new Invest(new Investor('any', new Wallet(Money::GBP(1000000)))))
            ->invest(
                $amount,
                $this->tranches[$tranche],
                $date
            );
    }

    /**
     * @Then :investor should get an exception error message
     */
    public function investorShouldGetAnExceptionErrorMessage(string $investor)
    {
        Assert::assertInstanceOf(InsufficientBalance::class, $this->error);
        Assert::assertContains(
            'Error: Tranche',
            $this->error->getMessage()
        );
    }

    /**
     * @Given investors have already invested :amount on :tranche
     */
    public function investorsHaveAlreadyInvestedOnTranche(Money $amount, Tranche $tranche)
    {
        throw new PendingException();
    }
}
