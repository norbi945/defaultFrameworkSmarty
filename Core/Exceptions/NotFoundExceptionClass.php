<?php

namespace Core\Exceptions;

use Core\Exceptions\AbstractExceptionClass;

class NotFoundExceptionClass extends AbstractExceptionClass
{
    /**
     * Hiba tempalte megjelenítés
     */
    public function showErrorTemplate()
    {
        var_dump($this->message, $this->code);
    }
}