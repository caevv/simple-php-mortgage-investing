<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Money\Money;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context
{
    /**
     * @var Investor
     */
    private $investor;

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
     * @Given :investor has :amount in his virtual wallet
     */
    public function hasInHisVirtualWallet(string $investorName, Money $amount)
    {
        $this->investor[$investorName] = new Investor($investorName, new Wallet($amount));
    }

    /**
     * @Given a loan starts on :loanBeginDate and ends on :loanEndDate
     */
    public function aLoanStartsOnAndEndsOn(\DateTimeImmutable $loanBeginDate, \DateTimeImmutable $loanEndDate)
    {
        throw new PendingException();
    }

    /**
     * @Given the loan has the following tranches:
     */
    public function theLoanHasTheFollowingTranches(TableNode $table)
    {
        throw new PendingException();
    }

    /**
     * @Given :investor invest :arg2 on tranche :tranche on :investDate
     * @Given :investor invest :arg2 on tranche :tranche
     */
    public function investOnTrancheAOn(Investor $investor, Tranche $tranche, DateTimeImmutable $investDate = null)
    {
        throw new PendingException();
    }

    /**
     * @When the interest is calculated for the period of :startDate to :endDate
     */
    public function theInterestCalculationIsDoneOnForThePeriodOfTo(DateTimeImmutable $startDate, DateTimeImmutable $endDate)
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
