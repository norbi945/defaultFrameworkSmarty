<?php

namespace Core;

use Smarty;

class TemplateManager extends Smarty
{
    public function __construct()
    {
        parent::__construct();
        $this->setTemplateDir('View');
        $this->setCompileDir('ViewC');
        $this->setConfigDir('vendor/smarty/smarty/configs');
        $this->setCacheDir('vendor/smarty/smarty/cache');
    }
}