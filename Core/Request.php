<?php

namespace Core;

class Request
{
    /** Getből jövő adatok */
    protected array $get;
    
    /** Postból jövő adatok */
    protected array $post;

    /** Hívott Controller */
    protected ?string $controller;

    /** Hívott Action */
    protected ?string $action;

    /** Request uri tömb */
    protected array $requestUriArray;

    public function __construct()
    {
        $this->processRequestData();
    }

    /**
     * Beállítjuk az osztály változók értékeit
     */
    private function processRequestData()
    {
        $this->get = !empty($_GET) ? $_GET : [];
        $this->post = !empty($_POST) ? $_POST : [];
        $this->requestUriArray = $this->processRequestUriData();
        $this->controller = $this->getController();
        $this->action = $this->getAction();
    }

    /** 
     * Feldogozza a server request_uri értéket 
     * 
     * @return array
     */
    private function processRequestUriData()
    {
        $serverUri = $_SERVER['REQUEST_URI'] ?? '/';
        $questionMarkPos = strpos($serverUri, '?');
        if ($questionMarkPos !== false) {
            $path = substr($serverUri, 0, strpos($serverUri, '?'));
        } else {
            $path = $serverUri;
        }
        
        $finalUriString = str_replace('/' . PROJECT_NAME . '/', '', $path);

        return $finalUriString !== '' ? explode('/', $finalUriString) : [];
    }
    
    /**
     * Kliens oldalról kívánt controller kifejtése
     * 
     * @return string
     */
    public function getController()
    {
        return $this->requestUriArray[0] ??  null;
    }
    
    /**
     * Kliens oldalról kívánt függvény kifejtése
     * 
     * @return null
     */
    public function getAction()
    {
        return $this->requestUriArray[1] ?? null;
    }

    /**
     * Kérés adatainak átadását végző fgv
     * 
     * @return array
     */
    public function returnRequestData()
    {
        return [
            'controller' => $this->controller,
            'action' => $this->action,
            'post' => $this->post,
            'get' => $this->get,
        ];
    }

}
