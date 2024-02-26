<?php

namespace Alsharie\AlQutaibiBankPayment\Responses;


class AlQutaibiBankErrorResponse extends AlQutaibiBankResponse
{
    protected $success = false;

    public function __construct($response, $status)
    {
        $this->data = (array) json_decode($response);
        $this->data['status_code'] = $status;
    }



}