<?php

namespace Alsharie\AlQutaibiBankPayment\Responses;


class AlQutaibiBankErrorResponse extends AlQutaibiBankResponse
{
    protected $success = false;

    public function __construct($response, $status, $request)
    {
        parent::__construct($response, $request);
        $this->data['status_code'] = $status;
    }


}