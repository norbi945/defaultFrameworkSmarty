<?php

namespace Core\Exceptions;

use Exception;

abstract class AbstractExceptionClass extends Exception
{
    /**
     * Hiba tempalte megjelenítés
     */
    abstract public function showErrorTemplate();

    /**
     * Template kirenderelése
     */
    public function renderTemplate()
    {

    }
}