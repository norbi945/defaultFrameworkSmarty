<?php

namespace Controller;

class HomeController extends AbstractMainController
{
    /** Alapértelmezett függvény */
    public string $defaultAction = 'show';

    public function __construct()
    {
    }

    public function show()
    {
        return $this->setTemplate([
            'homeMain' => $this->renderView('homeMain', [
            ]),
        ]);
    }

}