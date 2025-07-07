# ISO 20022 Payment

[![Build Status](https://travis-ci.org/z38/swiss-payment.png?branch=master)](https://travis-ci.org/z38/swiss-payment)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/z38/swiss-payment/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/z38/swiss-payment/?branch=master)

This package is a PHP library to generate ISO 20022 XML payment messages (pain.001) for use with Nordic and SEPA-compatible banks. It is based on the original [z38/swiss-payment](https://github.com/z38/swiss-payment) package and has been adapted to meet broader European use cases.

> 💡 Maintained by [R52dev](https://github.com/r52dev) as a fork of `invoicery/iso20022-payment`, which itself was based on the original Swiss implementation by `z38`.

## Installation

Just install [Composer](http://getcomposer.org) and run `composer require r52dev/iso20022-payment` in your project directory.

## Usage

To get a basic understanding on how the messages are structured, take a look [the resources](#further-resources) mentioned below. The following example shows how to create a message containing two transactions:

```php
<?php

use R52dev\ISO20022\BIC;
use R52dev\ISO20022\IBAN;
use R52dev\ISO20022\Message\CustomerCreditTransfer;
use R52dev\ISO20022\PaymentInformation\PaymentInformation;
use R52dev\ISO20022\TransactionInformation\BankCreditTransfer;
use R52dev\ISO20022\Money\DKK;

$payment = new PaymentInformation(
    'payment-001',
    'Acme Company',
    new BIC('NDEADKKK'),
    new IBAN('DK5000400440116243')
);

$transaction = new BankCreditTransfer(
    'instr-001',
    'e2e-001',
    new DKK(50000), // DKK 500.00
    'Philip Espersen',
    'Example Street 1, DK-1234 City',
    new IBAN('DK7620000123456789'),
    new BIC('NDEADKKK')
);

$payment->addTransaction($transaction);

$message = new CustomerCreditTransfer('msg-0001', 'From Acme Company');
$message->addPayment($payment);

echo $message->asXml();
```

**Tip:** Take a look at `Tests\Message\CustomerCreditTransferTest` to see all payment types in action.

## Caveats

- Not all business rules and recommendations are enforced, consult the documentation and **validate the resulting transaction file in cooperation with your bank**.
- At the moment cheque transfers are not supported (for details consult chapter 2.2 of the Implementation Guidelines)
- The whole project is still under development and therefore BC breaks can occur. Please contact me if you need a stable code base.

## Contributing

If you want to get your hands dirty, great! Here's a couple of steps/guidelines:

- Fork this repository
- Add your changes & tests for those changes (in `tests/`).
- Remember to stick to the existing code style as best as possible. When in doubt, follow `PSR-2`.
- Send me a pull request!

If you don't want to go through all this, but still found something wrong or missing, please
let me know, and/or **open a new issue report** so that I or others may take care of it.

## License & Credits

This library is licensed under MIT.
Originally created by [z38](https://github.com/z38), later adapted and extended by [invoicery](https://github.com/invoicery), and currently maintained by [R52dev](https://github.com/r52dev) for use with Nordic banks, including support for Danish BBAN structures and SEPA transfers.

## Further Resources

- [www.iso-payments.ch](http://www.iso-payments.ch) General website about the Swiss recommendations regarding ISO 20022
- [Swiss Business Rules for Customer-Bank Messages](http://www.six-interbank-clearing.com/dam/downloads/en/standardization/iso/swiss-recommendations/business-rules.pdf)
- [Swiss Implementation Guidelines for pain.001 and pain.002 Messages](http://www.six-interbank-clearing.com/dam/downloads/en/standardization/iso/swiss-recommendations/implementation-guidelines-ct.pdf)
- [SIX Validation Portal](https://validation.iso-payments.ch/)
- [PostFinance Validation Portal](https://isotest.postfinance.ch/corporates/)
