<?php

namespace Alsharie\AlQutaibiBankPayment;


use Alsharie\JawaliPayment\Helpers\JawaliAuthHelper;

class AlQutaibiBankAttributes extends Guzzle
{

    /**
     * Store request attributes.
     */
    protected array $attributes = [];

    protected array $headers = [];
    protected array $security = [];
    protected array $temp = [];

    public function disableVerify()
    {
        $this->security['verify'] = false;
        return $this;
    }


    /**
     * Input from customer
     * @param $no
     * @return AlQutaibiBankAttributes
     */
    public function setPaymentCustomerNo($no): AlQutaibiBankAttributes
    {
        $this->attributes['payment_CustomerNo'] = $no;
        return $this;
    }

    /**
     * Input from customer
     * @param $code
     * @return AlQutaibiBankAttributes
     */
    public function setPaymentCode($code): AlQutaibiBankAttributes
    {
        $this->attributes['payment_Code'] = $code;
        return $this;
    }


    /**
     * the payment currency (1: YER,2: SAR,3: USD)
     * @param $curr
     * @return AlQutaibiBankAttributes
     */
    public function setPaymentCurr($curr): AlQutaibiBankAttributes
    {
        $this->attributes['payment_Curr'] = $curr;
        return $this;
    }

    /**
     * @param $amount
     * @return AlQutaibiBankAttributes
     */
    public function setPaymentAmount($amount): AlQutaibiBankAttributes
    {
        $this->attributes['payment_Amount'] = $amount;
        return $this;
    }

    /**
     * @param $otp
     * @return AlQutaibiBankAttributes
     */
    public function setPaymentOTP($otp): AlQutaibiBankAttributes
    {
        $this->attributes['payment_OTP'] = $otp;
        return $this;
    }


    /**
     * @param array $attributes
     * @return AlQutaibiBankAttributes
     */
    public function setAttributes(array $attributes): AlQutaibiBankAttributes
    {
        $this->attributes = $attributes;
        return $this;
    }

    /**
     * @param array $attributes
     *
     * @return AlQutaibiBankAttributes
     */
    public function mergeAttributes(array $attributes): AlQutaibiBankAttributes
    {
        $this->attributes = array_merge($this->attributes, $attributes);
        return $this;
    }

    /**
     * @param mixed $key
     * @param mixed $value
     *
     * @return AlQutaibiBankAttributes
     */
    public function setAttribute($key, $value): AlQutaibiBankAttributes
    {
        $this->attributes[$key] = $value;
        return $this;
    }

    /**
     * @param mixed $key
     *
     * @return boolean
     */
    public function hasAttribute($key): bool
    {
        return isset($this->attributes[$key]);
    }

    /**
     * @param mixed $key
     *
     * @return AlQutaibiBankAttributes
     */
    public function removeAttribute($key): AlQutaibiBankAttributes
    {
        $this->attributes = array_filter($this->attributes, function ($name) use ($key) {
            return $name !== $key;
        }, ARRAY_FILTER_USE_KEY);

        return $this;
    }

    //payment_DestNation
    public function setPaymentDestNation($destNation): AlQutaibiBankAttributes
    {
        $this->attributes['payment_DestNation'] = $destNation;
        return $this;
    }

    /**
     * @return void
     */
    protected function setHeaderKeys()
    {
        $this->headers['X-APP-KEY'] = config('AlQutaibiBank.app_key');
        $this->headers['X-API-KEY'] = config('AlQutaibiBank.api_key');
    }

    /**
     * @throws \Exception
     */
    protected function setEncryptedCustomerNo()
    {
        $destnation_conf = config('AlQutaibiBank.payment_destnation');
        $destnation_atr = $this->attributes['payment_DestNation'] ?? null;
        if (empty($destnation_conf) && empty($destnation_atr)) {
            throw new \Exception('payment_DestNation is not set in the request');
        }
        $destnation = !empty($destnation_atr) ? $destnation_atr : $destnation_conf;

        $this->attributes['customer_no'] = $this->encryptString(config('AlQutaibiBank.api_key'), $destnation);
    }


    private function encryptString($key, $plainInput)
    {

        // IV must be exact 16 chars (128 bit)
        $iv = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);

// encryption
        $encrypted = base64_encode(openssl_encrypt($plainInput, 'aes-128-cbc', $key, OPENSSL_RAW_DATA, $iv));
        return $encrypted;

    }


}