<?php

namespace application\controllers;

use application\Controller;


class IndexController extends Controller
{

    public function actionIndex($layout, $tem)
    {
        $this->getModel()->setLayout($layout);
        $this->getModel()->setTemplate($tem);
    }


    public function actionMyAction(){
        $this->getModel()->setTemplate('index/index');
        $this->getModel()->setData("My action");

    }

    public function action404()
    {
        $this->getModel()->setTemplate('index/404');
    }
}