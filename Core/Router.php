<?php

namespace Core;

use Core\Exceptions\InternalExceptionClass;

final class Router
{
    /** @var string alap könyvtár */
    protected string $basePath;

    public function __construct()
    {
        $this->basePath = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . PROJECT_NAME;
    }

    /**
     * Visszatérünk a hívás példányosított class-al
     * 
     * @param array $requestData kérés paraméterei 
     */
    public function resolveRoute(array $requestData)
    {
        $controllerName = $this->processController($requestData);
        
        try {
            if (!class_exists($controllerName)) {
                throw new InternalExceptionClass('Internal Server Error! Class not exists!', 500);
            }
            
            $controllerObj = new $controllerName();
            $action = $requestData['action'] ?? $controllerObj->defaultAction;
            
            if (!is_callable([$controllerObj, $action])) {
                throw new InternalExceptionClass('Internal Server Error! Not calleable action!', 500);
            }
            
            return $controllerObj->{$action}();
        } catch (InternalExceptionClass $e)  {
            return $e->showErrorTemplate();
        }
    }

    /**
     * Hívandó controllernév meghatározása
     * 
     * @param array $requestData
     * 
     * @return string
     */
    private function processController(array $requestData = [])
    {

        if ($requestData['controller'] === null) {
            $controller = 'HomeController';
        } else {
            $controller = ucfirst($requestData['controller']) . 'Controller';
        }

        return "\\Controller\\{$controller}";
    }
}