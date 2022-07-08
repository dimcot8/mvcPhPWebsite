<?php

class Router
{
    private $controller;

    private $pathParts = [];

    public function __construct()
    {
        $this->pathParts = explode('/', trim($_SERVER['REQUEST_URI'], " \t\n\r\0\x0B/"));
    }

    public function getController()
    {
        if (null == $this->controller) {
            $this->prepareController();
        }

        return $this->controller;
    }

    private function prepareController()
    {
        unset($this->pathParts[0]);
        $this->controller = array_shift($this->pathParts) ?: 'index';

        $parts = array_merge(explode('-', $this->controller), ['Controller']);
        $this->controller = '\application\controllers\\';

        foreach ($parts as $part) {
            $this->controller .= ucfirst(strtolower($part));
        }
    }

    private $action = null;

    public function getAction()
    {
        if (null == $this->action) {
            $this->prepareAction();
        }
        return $this->action;
    }

    public function prepareAction()
    {
//        unset($this->pathParts[1]);
        $this->action = array_shift($this->pathParts) ?: 'index';

        $parts = explode('-', $this->action);

        $this->action = 'action';
        foreach ($parts as $part) {
            $this->action .= ucfirst(strtolower($part));
        }

    }
}