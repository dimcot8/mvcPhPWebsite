<?php

namespace application\controllers;
use application\Controller;
use application\models\UsersModel;

class UserController extends Controller
{
    public function actionFind(){

//        $userModel = new UsersModel();
//        $users = $userModel->logInUser();
//    $this->getModel()->setData($users);

    }

    public function actionAdd(){
        $this->getModel()->setTemplate('user/add');
    }
}