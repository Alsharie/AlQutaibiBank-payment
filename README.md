# AlQutaibiBank-payment

![img.svg](img.svg)

laravel package for AlQutaibiBank payment getway
install the package
`composer require alsharie/AlQutaibiBank-payment`

You can publish using the following command

`php artisan vendor:publish --provider="Alsharie\AlQutaibiBankPayment\AlQutaibiBankServiceProvider"`

When published, the `config/AlQutaibiBank.php` config file contains:

```php
return [
    'auth' => [
        'username' => env('AlQutaibiBank_MERCHANT_USERNAME'),
        'password' => env('AlQutaibiBank_MERCHANT_PASSWORD'),
    ],
    'url' => [
        'base' => env('AlQutaibiBank_BASE_URL', 'https://api.AlQutaibiBank.ye:49901'),
    ]
];
```


--------------------
### login

```php
    $AlQutaibiBank = new AlQutaibiBank();
    $response = $AlQutaibiBank->login();

    if ($response->isSuccess()) {
        $response->getToken();
    }
```
--------------------

To purchase using AlQutaibiBank payment

### 1. Purchase

```php
    $AlQutaibiBank = new AlQutaibiBank();
    $response = $AlQutaibiBank
        ->setCurrency(2)
        ->setNote('this is simple note')
        ->setAmount(3000)
        ->setBeneficiaryTerminal(1)
        ->setSourceCode(/*phone number*/)
        ->initPayment();

    if ($response->isSuccess()) {
        $response->getAdjustment();
        ... 
        ...
    } 
       
```

### 2. Confirm purchase

```php
    $AlQutaibiBank = new AlQutaibiBank();
    $response = $AlQutaibiBank
        ->setAdjustmentId(603414)
        ->setOtp(5761)
        ->setOperationApprove()
        ->setNote('تاكيد عملية الدفع')
        ->confirmPayment();
    if ($response->isSuccess()) {
        return $response->getTransactionId();
    }
```

### 3. Check Transaction Status

```php
    $AlQutaibiBank = new AlQutaibiBank();
    $response = $AlQutaibiBank
        ->setTransactionId(/*tranId*/)
        ->checkTransactionStatus();

    if ($response->isSuccess()) {
        return $response->getStatus();
    }
```

you can get the full **response body** using `$response->body()` for all requests