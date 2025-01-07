<?php

namespace App\Exceptions;

use Exception;

class GridlinesApiException extends Exception
{
    protected $data;

    public function __construct($message, $data = [])
    {
        parent::__construct($message);
        $this->data = $data;
    }

    public function getErrorData()
    {
        return $this->data;
    }
}
