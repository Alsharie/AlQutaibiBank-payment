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
    public $request;

    /**
     * Response constructor.
     */
    public function __construct($response,$request)
    {
        $this->data = (array)json_decode($response, true);
        $this->request = $request;
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
        if(isset($this->data['status'])){
            return $this->data['status'];
        }
        return false;
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