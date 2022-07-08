<?php

namespace application\controllers;

use application\Controller;

class MySecondController extends Controller
{
    public function actionMySecond(){
        $this->getModel()->setTemplate('my-second/my-second');
        $this->getModel()->setData("My second action");
    }
}