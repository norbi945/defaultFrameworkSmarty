<?php

namespace Core;

use Core\Router;
use Core\Request;
use Core\Exceptions\NotFoundExceptionClass;

final class Application 
{
    /** @var Request Kérés objektum */
    protected Request $request;

    public function __construct()
    {
        $this->request = new Request();
    }
    
    public function run(Router $router)
    {
        $requestData = $this->request->returnRequestData();
        try {
            return $router->resolveRoute($requestData);
        } catch (NotFoundExceptionClass $e) {
            return $e->showErrorTemplate();
        }
    }

}