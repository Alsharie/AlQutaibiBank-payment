<?php

namespace Alsharie\AlQutaibiBankPayment\Responses;


class AlQutaibiBankResponse
{
    protected $success = true;
    /**
     * Store the response data.
     *
     * @var array
     */
    protected $data = [];

    /**
     * Response constructor.
     */
    public function __construct($response)
    {
        $this->data = (array)json_decode($response, true);
    }


    /**
     * @return mixed
     */
    public function __get($name)
    {
        return $this->data[$name];
    }

    /**
     * @return array
     */
    public function body()
    {
        return $this->data;
    }

    public function isSuccess()
    {
        return ($this->data['status']);
    }


    //description
    public function getDescription()
    {
        if (!empty($this->data['description'])) {
            return $this->data['description'];
        }

        return false;
    }

    //errorCode
    public function getErrorCode()
    {
        if (!empty($this->data['errorCode'])) {
            return $this->data['errorCode'];
        }

        return false;
    }


}