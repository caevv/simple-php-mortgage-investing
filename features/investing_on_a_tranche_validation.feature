Feature: Failing to invest on a tranche

  Background:
    Given a loan starts on "01/10/2015" and ends on "15/11/2015"

  Scenario: Failing to invest on a tranche when not enough amount is available
    Given a loan has the following tranches:
      | Name | Interest | Amount Available |
      | A    | 3%       | 1000 GBP         |
    And "investor 3" has "1000 GBP" in his virtual wallet
    And investors have already invested "1000 GBP" on tranche A
    When "investor 2" invest "1 GBP" on tranche A on "04/10/2015"
    Then the investor should get an exception error message

  Scenario: Failing to invest on a tranche when not enough amount is available
    Given a loan has the following tranches:
      | Name | Interest | Amount Available |
      | B    | 6%       | 1000 GBP         |
    And "investor 4" has "1000 GBP" in his virtual wallet
    And investors have already invested "500 GBP" on tranche B
    When "investor 4" invest "1100 GBP" on tranche "B" on "25/10/2015"
    Then the investor should get an exception error message
