<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Money\Currencies\ISOCurrencies;
use Money\Currency;
use Money\Formatter\DecimalMoneyFormatter;
use Money\Money;
use Money\Parser\DecimalMoneyParser;
use PHPUnit\Framework\Assert;

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
     *
     * @param string $dateString
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
        $this->investments[$investor] = (new Invest($this->investors[$investor]))->invest(
            $amount,
            $this->tranches[$tranche],
            $investDate ?: new DateTimeImmutable()
        );
    }

    /**
     * @When the interest is calculated for the period of :startDate to :endDate
     */
    public function theInterestsCalculatedForThePeriodOfTo(DateTimeImmutable $startDate, DateTimeImmutable $endDate)
    {
        $this->interest = (new CalculateInvestment($this->investments))->calculate($endDate);
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
     * @Given investors have already invested :amount on tranche :tranche
     */
    public function investorsHaveAlreadyInvestedOnTrancheA(Money $amount, Tranche $tranche)
    {
        throw new PendingException();
    }

    /**
     * @Then the investor should get an exception error message
     */
    public function theInvestorShouldGetAnExceptionErrorMessage()
    {
        throw new PendingException();
    }

    /**
     * @Given investors have already invested :amount on :tranche
     */
    public function investorsHaveAlreadyInvestedOnTranche(Money $amount, Tranche $tranche)
    {
        throw new PendingException();
    }
}
