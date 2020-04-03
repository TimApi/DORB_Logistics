<?php
require('database/db.php');

$hallo = $_POST["id"];
$gebruiker = $_SESSION['userid'];


$statement = $conn->prepare("SELECT * FROM users WHERE id =:id");
$statement->execute(
    array(':id' => $hallo
    ));
$users = $statement->fetch();

?>

<div class="wrapper fadeInDown">
    <div id="formContent">
        <!-- Tabs Titles -->
        <!-- Login Form -->

        <h2>Change profile</h2>
        <form class="form-horizontal" action="php/usersaanpassen.php" method="POST">
            <input type="text" id="login" class="fadeIn second" value="<?php  echo $users["email"] ?>" name="email" placeholder="Email" required>
            <input type="text" id="username" class="fadeIn second"  value="<?php  echo $users["username"] ?>" name="username" placeholder="Username" required>
            <input type="hidden"value="<?= $users['id'] ?>" name="id">
            <input type="submit" class="fadeIn fourth" name="submit" value="Change">
        </form>
    </div>
</div>