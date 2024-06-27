# Sohojpay API Library for PHP

This is a PHP library to interact with the Sohojpay API. This library allows you to create and verify payments using the Sohojpay payment gateway.

## Features

- Easy integration with the Sohojpay payment gateway.
- Create and verify payments.
- Customizable headers and parameters.

## Installation

To install the library, you can use Composer or manually include the library in your project.

### Using Composer

```bash
composer require sohojpay/sohojpay-lib
```

Manual Installation:
Download the library and place it in your project directory. Include the library in your project:

require_once 'path/to/Sohojpay/SohojpayLib/SohojpayApi.php';
### Usage
To use the library, create a class that extends the SohojpayApi abstract class and implement any additional methods you might need.

Example:

<?php
require_once 'path/to/Sohojpay/SohojpayLib/SohojpayApi.php';

use Sohojpay\SohojpayLib\SohojpayApi;

class MySohojpay extends SohojpayApi
{
    // You can implement additional methods if needed
}

$sohojpay = new MySohojpay();
$sohojpay->setApi('YOUR_API_KEY');
$sohojpay->setUrl('https://secure.sohojpaybd.com/api/');


// Set request parameters
$sohojpay->setParams([
    'cus_name' => 'John Doe',
    'cus_email' => 'johndoe@example.com',
    'cus_phone' => '0123456789',
    'metadata' => json_encode(['phone' => '0123456789']),
    'success_url' => 'https://yourwebsite.com/success',
    'cancel_url' => 'https://yourwebsite.com/cancel',
]);

// Create a payment
$response = $sohojpay->createPayment();
echo $response;

// Verify a payment
$sohojpay->setParams([
    'transaction_id' => 'GCAN7A410970'
]);
$response = $sohojpay->verifyPayment();
echo $response;

?>
