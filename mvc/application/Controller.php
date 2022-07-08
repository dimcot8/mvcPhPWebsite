<?php

namespace application;

class Controller
{
    private $model;
    private $action;

    /**
     * @return mixed
     */
    public function getAction()
    {
        return $this->action;
    }

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function getModel()
    {
        return $this->model;
    }
}