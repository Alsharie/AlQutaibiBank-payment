<?php

namespace Alsharie\AlQutaibiBankPayment;


use Alsharie\AlQutaibiBankPayment\Responses\AlQutaibiBankErrorResponse;
use Alsharie\AlQutaibiBankPayment\Responses\AlQutaibiBankRequestPaymentResponse;

class AlQutaibiBank extends AlQutaibiBankAttributes
{


    /**
     * It Is used to allow the merchant to initiate a payment for a specific customer.
     * @return AlQutaibiBankRequestPaymentResponse|AlQutaibiBankErrorResponse
     */
    public function RequestPayment()
    {

        if (!isset($this->attributes['payment_Curr'])) {
            $this->attributes['payment_Curr'] = 1;// default currency is YER
        }

        try {
            // set header info
            $this->setEncryptedCustomerNo();
            $this->setHeaderKeys();
            $response = $this->sendRequest(
                $this->getRequestPaymentPath(),
                $this->attributes,
                $this->headers,
                $this->security
            );

            return new AlQutaibiBankRequestPaymentResponse((string)$response->getBody());
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            return new AlQutaibiBankErrorResponse($e->getResponse()->getBody(), $e->getResponse()->getStatusCode());
        } catch (\Exception $e) {
            return new AlQutaibiBankErrorResponse($e->getTraceAsString(), $e->getCode());
        }
    }


    /**
     * It is used to confirm the initPayment request
     * @return AlQutaibiBankRequestPaymentResponse|AlQutaibiBankErrorResponse
     */
    public function confirmPayment()
    {

        try {
            // set header info
            $this->setEncryptedCustomerNo();
            $this->setHeaderKeys();
            $response = $this->sendRequest(
                $this->getConfirmPaymentPath(),
                $this->attributes,
                $this->headers,
                $this->security,
            );

            return new AlQutaibiBankRequestPaymentResponse((string)$response->getBody());
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            return new AlQutaibiBankErrorResponse($e->getResponse()->getBody(), $e->getResponse()->getStatusCode());
        } catch (\Exception $e) {
            return new AlQutaibiBankErrorResponse($e->getTraceAsString(), $e->getCode());
        }
    }


}