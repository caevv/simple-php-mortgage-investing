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

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context
{
    /**
     * @var Investor[]
     */
    private $investor;

    /**
     * @var Loan
     */
    private $loan;

    /**
     * @var Tranche[]
     */
    private $tranche;

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
        $this->investor[$investorName] = new Investor($investorName, new Wallet($amount));
    }

    /**
     * @Given a loan starts on :loanBeginDate and ends on :loanEndDate with the following tranches:
     */
    public function aLoanStartsOnAndEndsOn(\DateTimeImmutable $loanBeginDate, \DateTimeImmutable $loanEndDate, TableNode $table)
    {
        foreach ($table as $trancheData) {
            $interest = explode('%', $trancheData['Interest'])[0];
            $this->tranche[$trancheData['Name']] = new Tranche($trancheData['Name'], $interest, $this->makeMoney($trancheData['Amount Available']));
        }

        $this->loan = new Loan($this->tranche, $loanBeginDate, $loanEndDate);
    }

    /**
     * @Given :investor invest :amount on tranche :tranche on :investDate
     * @Given :investor invest :amount on tranche :tranche
     */
    public function investOnTrancheAOn(string $investor, Money $amount, string $tranche, DateTimeImmutable $investDate = null)
    {
        $this->investor[$investor]->invest($amount, $this->tranche[$tranche], $investDate ?: new DateTimeImmutable());
    }

    /**
     * @When the interest is calculated for the period of :startDate to :endDate
     */
    public function theInterestisCalculatedForThePeriodOfTo(DateTimeImmutable $startDate, DateTimeImmutable $endDate)
    {
        throw new PendingException();
    }

    /**
     * @Then :investor earns :amount
     */
    public function earns(Investor $investor, Money $amount)
    {
        throw new PendingException();
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
