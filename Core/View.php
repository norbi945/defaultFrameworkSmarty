<?php

namespace Core;

use Core\Exceptions\NotFoundExceptionClass;

class View 
{
    /** Template data */
    protected array $data;

    /** Template elérése */
    protected string $templatePath;

    public function __construct(string $templateName, array $data = [])
    {
        $this->data = $data;

        $viewFilePathArray = [
            $_SERVER['DOCUMENT_ROOT'],
            PROJECT_NAME,
            'View',
            $templateName . '.tpl',
        ];

        $this->templatePath = implode(DIRECTORY_SEPARATOR, $viewFilePathArray);
    }

    /**
     * Tempalte összegyűjtése
     */
    public function getView()
    {
        $templateManager = new TemplateManager();
        
        foreach ($this->data as $key => $value) {
            $templateManager->assign($key, $value);
        }
        
        return $templateManager->fetch($this->templatePath);
    }
    
    /**
     * template kirenderelése
     */
    public function displayTemplate()
    {
        $templateManager = new TemplateManager();
        foreach ($this->data as $key => $value) {
            $templateManager->assign($key, $value);
        }

        return $templateManager->display($this->templatePath);
    }
}