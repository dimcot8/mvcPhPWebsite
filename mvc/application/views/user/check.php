<?php
session_start();
$id = $_GET['done'];
if (isset( $_POST['check']))
    $value =$_POST['check'];

//$conn1 = db2_connect("192.168.64.2", "test", "1qazxsw2", "users");
$conn = mysqli_connect
("192.168.64.2", "test", "1qazxsw2", "users");

if (mysqli_query($conn, "UPDATE `todo` SET `done`=TRUE  WHERE `id`= $id"))

$value='yes';

    echo 'Вы отметили задание как выполненое.';
?>

<br><a href="/menu1.php">Назад</a>

