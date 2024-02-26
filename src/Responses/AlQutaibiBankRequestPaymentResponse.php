<?php

namespace Alsharie\AlQutaibiBankPayment\Responses;


class AlQutaibiBankRequestPaymentResponse extends AlQutaibiBankResponse
{


    public function getTransactionID()
    {
        if (!empty($this->data['transactionID'])) {
            return $this->data['transactionID'];
        }

        return false;
    }

}