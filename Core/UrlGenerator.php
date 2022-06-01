<?php

namespace Core;

class UrlGenerator 
{
    public function __construct()
    {
    }

    /**
     * Legenerálja az url-t
     * 
     * @param string $controller Controller neve
     * @param string $action hívandó Függvény neve
     * @param array $parameters Küldött paraméterek
     * 
     * @return string
     */
    public static function generateUrl($controller = '', $action = '', $parameters = [])
    {
        $params =  '/' . PROJECT_NAME;

        if ($controller !== '') {
            $params .= '/' . $controller;
        }

        if ($action !== '') {
            $params .= '/' . $action . '?';
        }

        if (!empty($parameters)) {
            $firstParam = array_key_first($parameters);
            foreach ($parameters as $param => $value) {
                if ($param === $firstParam) {
                    $params .= $param . '=' . $value; 
                } else {
                    $params .= '&' . $param . '=' . $value; 
                }
            }
        
            return $params;
        }
    }
}