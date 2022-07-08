<?php

namespace application\models;
use Exception;

use application\Model;

class IndexModel extends Model
{
    private $mysqliDriver;


    public function __construct($mysqliDriver)
    {
        $this->mysqliDriver = $mysqliDriver;
    }

    public function addTask()
    {
        try {


            $task = $_POST['task'];

            $login1 =  $_SESSION['login'];


                    $sql = "INSERT INTO todo (`name`, `users_login`) VALUES ('$task', '$login1')";


                        mysqli_query($this->mysqliDriver, $sql);


        } catch (Exception $exception) {
            $exception->getMessage();
        }
    }
}