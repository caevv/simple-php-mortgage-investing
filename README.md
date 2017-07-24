# Mortgage Investment

## Installation

```docker-compose up -d```

```docker-compose exec php-dev composer install```

## Usage

Features can be found on /features with the investment and how it's done.

Run tests:

```docker-compose exec php vendor/bin/phpspec run```

```docker-compose exec php vendor/bin/behat```

## How it calculates
- It done through Investment\Calculate which receives an array of Investments, then it calculates the interest for each.
- An investment consists of an id, the Investor, the time of the investment, the Tranche and the Amount.
- An investor has a wallet. 
 
 ## Notes
 - There were no Application layer. The scenario has been written on the Domain layer only.
 - The application layer can be done using any framework or even vanilla PHP and can be achieved quite fast by using the Domain.
- Domain is on src/
