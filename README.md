# Omnipay: Everywhere Processing Network (eProcessingNetwork)

**eProcessingNetwork driver for the Omnipay PHP payment processing library**

[![Latest Stable Version](https://poser.pugx.org/bmstanley/omnipay-epn/version.png)](https://packagist.org/packages/bmstanley/omnipay-epn)
[![Total Downloads](https://poser.pugx.org/bmstanley/omnipay-epn/d/total.png)](https://packagist.org/packages/bmstanley/omnipay-epn)
[![License](https://poser.pugx.org/bmstanley/omnipay-epn/license)](https://packagist.org/packages/bmstanley/omnipay-epn)

[Omnipay](https://github.com/thephpleague/omnipay) is a framework agnostic, multi-gateway payment processing library for
PHP. This package implements Everywhere Processing Network (eProcessingNetwork) support for Omnipay.

## Installation

Omnipay is installed via [Composer](http://getcomposer.org/). To install, simply require `league/omnipay`
and `bmstanley/omnipay-epn` with Composer:

```
composer require league/omnipay bmstanley/omnipay-epn
```

## Basic Usage

The following gateways are provided by this package:

* [TDBE](https://www.eprocessingnetwork.com/tdbe_doc.html)

The gateway requires your ePN Account Number and Restrict Key to be able to authorize your requests. You can configure the gateway by either passing your `accountNumber` and `restrictKey` via the gateway's `initialize` method or setter methods.

via `initialize method`
```php
\Omnipay\Omnipay::register(\Omnipay\eProcessingNetwork\Gateway::class);
$gateway = \Omnipay\Omnipay::create('eProcessingNetwork');
$gateway->initialize([
    'accountNumber' => 'your_epn_account_number',
    'restrictKey' => 'your_restrict_key',
]);
```

or via setter methods
```php
\Omnipay\Omnipay::register(\Omnipay\eProcessingNetwork\Gateway::class);
$gateway = \Omnipay\Omnipay::create('eProcessingNetwork')
    ->setAccountNumber('your_epn_account_number')
    ->setRestrictKey('your_restrict_key');
```

Once the gateway is configured, you can create and send your request by calling the appropriate request method.
```php
$response = $gateway->purchase(['amount' => '10.00', 'card' => $card])->send();
```

For general usage instructions, please see the main [Omnipay](https://github.com/thephpleague/omnipay)
repository.

## Test Mode

If you want to run the test suites, copy the `phpunit.xml.dist` file to `phpunit.xml` and update the following values:

- EPN_ACCOUNT
- RESTRICT_KEY

## Support

If you are having general issues with Omnipay, we suggest posting on
[Stack Overflow](http://stackoverflow.com/). Be sure to add the
[omnipay tag](http://stackoverflow.com/questions/tagged/omnipay) so it can be easily found.

If you want to keep up to date with release announcements, discuss ideas for the project, or ask more detailed
questions, there is also a [mailing list](https://groups.google.com/forum/#!forum/omnipay) which you can subscribe to.

If you believe you have found a bug, please report it using
the [GitHub issue tracker](https://github.com/bmstanley/omnipay-epn/issues), or better yet, fork the library and submit
a pull request.
