Feature: Failing to invest on a tranche

  Scenario: Failing to invest on a tranche when not enough amount is available
    Given a loan starts on "01/10/2015" and ends on "15/11/2015" with the following tranches:
      | Name | Interest | Amount Available |
      | A    | 3%       | 1000 GBP         |
    And "investor 3" has "1000 GBP" in his virtual wallet
    And investors have already invested "1000 GBP" on tranche A on "03/10/2015"
    When "investor 3" invest "1 GBP" on tranche A on "04/10/2015"
    Then "investor 3" should get an error message with insufficient balance on tranche

  Scenario: Failing to invest on a tranche when not enough amount is available
    Given a loan starts on "01/10/2015" and ends on "15/11/2015" with the following tranches:
      | Name | Interest | Amount Available |
      | B    | 6%       | 1000 GBP         |
    And "investor 4" has "1000 GBP" in his virtual wallet
    And investors have already invested "500 GBP" on tranche B on "24/10/2015"
    When "investor 4" invest "1100 GBP" on tranche "B" on "25/10/2015"
    Then "investor 4" should get an error message with insufficient balance on tranche
