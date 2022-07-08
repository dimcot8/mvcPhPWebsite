<?php if (isset($_SESSION['login'])){

    ?>
<form method="post" action="/index.php">
<button type="submit" name="logout">Log out</button>
</form>
<h2>Todo list</h2>

<form method="post" action="/index.php">
    <input type="text" name="task" class="task_input">
<!--</form>-->
    <button type="submit" name="add_task" class="task_btn">Add task</button>
<table border="1">
    <tr>
        <td>Задание</td>

        <td>Выполнено</td>

        <td>Удалить</td>

        <td>Редактировать</td>
    </tr>

    <?php
    $conn = mysqli_connect
    ("192.168.64.2", "test", "1qazxsw2", "users");

    $login1 =  $_SESSION['login'];

    $tasks = mysqli_query($conn, "SELECT * FROM todo WHERE `users_login`='$login1'");

    $i = 1;
    while ($row = mysqli_fetch_array($tasks)) {
        ?>
         <tr>
 <td> <?php echo $i .'. '; echo $row['name'] ?> </td>

            <td class="task">

                    <button name="check" id="check" value="no">
                        <a href="/application/views/user/check.php?done=<?php echo $row['id']?>">
                            Выполнено</a></button>

            </td>



             <td>
<a href="/application/views/user/delete.php?id=<?php echo $row['id'] ?>"<button type="submit" name="delete">Delete</button></a>

 </td>

  <td>
      <a href="/application/views/user/edit.php?edit=<?php echo $row['id'] ?>" <button type="submit" name="edit">Edit</button>
 </td>

        <?php $i++; } ?>

</tr>
</table>
</form>

<?php }  else
    die('Error');?>


