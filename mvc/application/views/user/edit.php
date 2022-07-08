<?php if(isset($_GET['edit']))
{
    $conn = mysqli_connect
    ("192.168.64.2", "test", "1qazxsw2", "users");
$id = $_GET['edit'];

    $name = $_POST['name'];

echo "
<form method='POST'>
    <p>Введите новое название:<br>
        <input type='text' name='name' value='$name' /></p>
    <input type='submit' value='Сохранить'>
</form>";
    $query ="UPDATE todo SET name='$name' WHERE id='$id'";

   $result = mysqli_query($conn, $query);

}
?>
<br><a href="/menu1.php">Назад</a>