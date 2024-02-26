<?php

namespace Alsharie\AlQutaibiBankPayment\Facade;

use Illuminate\Support\Facades\Facade;
use Alsharie\AlQutaibiBankPayment\AlQutaibiBank;

class AlQutaibiBankPaymentGateway extends Facade
{
    /**
     * Get the binding in the IoC container
     *
     */
    protected static function getFacadeAccessor()
    {
        return AlQutaibiBank::class;
    }
}