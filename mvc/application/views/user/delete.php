<?php

$id = $_GET['id'];
    $conn = mysqli_connect
    ("192.168.64.2", "test", "1qazxsw2", "users");
    mysqli_query($conn, "DELETE FROM todo WHERE id = $id");
echo 'Вы удалили задание. ';
?>
<br><a href="/menu1.php">Назад</a>




