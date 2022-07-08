<?php

namespace application\models;

use application\controllers\IndexController;
use application\Model;

use Exception;


class UsersModel extends Model
{

    private $mysqliDriver;


    public function __construct($mysqliDriver)
    {
        $this->mysqliDriver = $mysqliDriver;
    }

    public function logInUser()
    {

        $login1 = $_POST['login1'];

        $pass = md5($_POST['password1']);

        $query = "SELECT * FROM `users` WHERE `login` = ?";
        $stmt = mysqli_stmt_init($this->mysqliDriver);

        if (mysqli_stmt_prepare($stmt, $query)) {
            mysqli_stmt_bind_param($stmt, 's', $login1);
            mysqli_stmt_execute($stmt);

            $res = mysqli_stmt_get_result($stmt);

            if ($data = mysqli_fetch_assoc($res)) {

                if ($pass == $data['password']) {

                    $_SESSION['login'] = $data['login'];
                    $_SESSION['pass'] = $data['password'];
                    $_SESSION['id'] = $data['id'];
                    $_SESSION['name'] = $data['name'];
                    echo "<h1>Welcome, " . $_SESSION['name'] . "!" . "</h1>";
                    echo "You have logged in successfully";


                } else {
                    die ("Incorrect password");
                }
            } else {
                die ("Incorrect login");
            }
        } else {
            die ("Error");
        }


    }


    public function addUser()
    {

            $login = $_POST['userlogin'];
            $name = $_POST['name'];
            $email = $_POST['email'];
            $pass = md5($_POST['password']);


            $sql = "INSERT INTO `users`(`login`, `password`, `name`, `email`)
 VALUES ('$login', '$pass', '$name', '$email')";



            if (mysqli_query($this->mysqliDriver, $sql)){
                $_SESSION['login'] = $_POST['userlogin'];
                $_SESSION['name'] = $_POST['name'];
                $_SESSION['email']= $_POST['email'];
                $_SESSION['pass'] = $_POST['password'];
                echo "<h1>Welcome, " . $_SESSION['name'] . "!" . "</h1>";

            }
    }


}