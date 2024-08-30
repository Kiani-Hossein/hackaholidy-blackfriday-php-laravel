<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;

/**
 *
 */
abstract class Controller
{
    /**
     * @var ResponseHelper
     */
    protected ResponseHelper $response;

    /**
     *
     */
    public function __construct() {
        $this->response = new ResponseHelper;
    }
}
