<?php

session_start();
//require_once(__DIR__ . Autoload::class.DIRECTORY_SEPARATOR);
require_once __DIR__ . '/Autoload.php';
require_once __DIR__.'/application/Controller.php';
use application\library\MySQLiDriver;
spl_autoload_register(['Autoload', 'loader']);

$router = new Router();
$model = new \application\Model();

$mysqli = mysqli_connect
("192.168.64.2", "test", "1qazxsw2", "users");



    $controller = $router->getController();
    if (method_exists(Router::class, 'getAction') and
        method_exists(Router::class, 'getController')) {

        if (!isset($_POST['login'])) {
            if (!isset($_POST['signup'])) {
                if (!isset($_POST['logout'])) {
                    if (!isset($_POST['add_task'])) {

 (new \application\controllers\IndexController($model))->actionIndex('menu', 'index/index');

                    } else {
                        (new \application\models\IndexModel($mysqli))->addTask();
                        (new \application\controllers\IndexController($model))->
                        actionIndex('menu1', 'index/welcome');
                    }

                } else {
                    session_destroy();
                    (new \application\controllers\IndexController($model))->
                    actionIndex('menu', 'index/index');
                }
            } else {
                (new \application\models\UsersModel($mysqli))->addUser();
                (new \application\controllers\IndexController($model))->
                actionIndex('menu1', 'index/welcome');
            }
        } else {
            (new \application\models\UsersModel($mysqli))->logInUser();
            (new \application\controllers\IndexController($model))->
            actionIndex('menu1', 'index/welcome');
        }

    } else {
        (new \application\controllers\IndexController($model))->action404();
    }


    try {

        (new \application\View($model))->render();
    } catch (Exception $exception) {
        die($exception->getMessage());
    }

