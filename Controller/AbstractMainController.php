<?php

namespace Controller;

use Core\Controller;
use Core\Menus\CategoriesMainMenu;

class AbstractMainController extends Controller
{
    /** Fő template meghatározása */
    public function setTemplate($tempalteData) 
    {
        return $this->renderView('mainTemplateMain', $tempalteData);
    }
}