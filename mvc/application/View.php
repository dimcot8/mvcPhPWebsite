<?php

namespace application;

class View
{

    private $model;

    /**
     * @return mixed
     */
    public function getModel()
    {
        return $this->model;
    }

    private $templatePath = __DIR__ . "/views";

    private $layoutPath = __DIR__ . "/views/layouts";


    public function __construct($model)
    {
        $this->model = $model;
    }

    public function render()
    {
        $layout = sprintf('%s/%s.php', $this->layoutPath, $this->model->getLayout());

        $template = sprintf('%s/%s.php', $this->templatePath, $this->model->getTemplate());

        if (!file_exists($layout)) {
            throw new \Exception("Layout '($layout)' does not exist");
        }
 elseif (!file_exists($template)) {
            throw new \Exception("Template '($template)' does not exist");

        }

        require_once($layout);

        require_once($template);
    }
}