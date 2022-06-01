<?php

namespace Core;

abstract class Controller
{   
    /** Aktuális Controller neve */
    protected string $controllerName;
    
    /** Alapértelmezett függvény */
    protected string $defaultAction;

    public function __construct()
    {
    }

    /** Nézet renderelése */
    public function renderView(string $viewName, array $viewData = []) 
    {
        $view = new View($viewName, $viewData);
        return $view->getView();
    }

    /** Json visszatérés */
    public function returnJson($data)
    {
        header('Content-type: application/json');
        return json_encode($data);
    }

        /** 
     * Post adat kérése 
     * 
     * @param $dataName kellő adat
     * 
     * @return mixed
     */
    public function getPostParam($dataName)
    {
        return $_POST[$dataName] ?? '';
    }
    
    /** 
     * Get adat kérése 
     * 
     * @param $dataName kellő adat
     * 
     * @return mixed
     */
    public function getGetParam($dataName)
    {   
        return $_GET[$dataName] ?? '';
    }
}