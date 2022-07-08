<?php

namespace application;

class Model
{
    private $data = null;

    public function getData()
    {
        return $this->data;
    }

    public function setData($data)
    {
        $this->data = $data;
    }

    /**
     * @return string
     */
    public function getLayout(): string
    {
        return $this->layout;
    }

    /**
     * @param string $layout
     */
    public function setLayout(string $layout)
    {
        $this->layout = $layout;
    }
//
    private $layout = 'menu';
//
//
    private $template = 'index';

    /**
     * @return string
     */
    public function getTemplate(): string
    {
        return $this->template;
    }

    /**
     * @param string $template
     */
    public function setTemplate(string $template)
    {
        $this->template = $template;
    }


}