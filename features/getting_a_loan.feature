Feature: Getting a loan

  Rules:
  - Each loan has a start date and an end date.
  - Each loan is split in multiple tranches.
  - Each tranche has a different monthly interest percentage.
  - Also each tranche has a maximum amount available to invest. So once the maximum is
  reached, further investments can't be made in that tranche.
  - As an investor, I can invest in a tranche at any time if the loan it’s still open, the maximum
  available amount was not reached and I have enough money in my virtual wallet.
  - At the end of the month we need to calculate the interest each investor is due to be paid.

  Background:
    Given "investor 1" has "1000 GBP" in his virtual wallet
    And "investor 3" has "1000 GBP" in his virtual wallet

  Scenario:
    Given a loan starts on "01/10/2015" and ends on "15/11/2015" with the following tranches:
      | Name | Interest | Amount Available |
      | A    | 3%       | 1000 GBP         |
      | B    | 6%       | 1000 GBP         |
    And "investor 1" invest "1000 GBP" on tranche A on "03/10/2015"
    And "investor 3" invest "500 GBP" on tranche B on "10/10/2015"
    When the interest is calculated for the period of "01/10/2015" to "31/10/2015"
    Then "investor 1" earns "28.06 GBP"
    And "investor 2" earns "21.29 GBP"
