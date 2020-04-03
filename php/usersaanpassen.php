<?php
require('../database/db.php');
session_start();



$id = $_SESSION['userid'];
$email = $_POST['email'];
$username = $_POST['username'];




$sql = "UPDATE `users` SET `email`=:email,`username`=:username WHERE id=:id";
$statement = $conn->prepare($sql);


$statement -> execute(array(
    ':email' => $email,
    ':username' => $username,
    ':id' => $id


));
echo "<script>
alert('succesful');
window.location.href='http://localhost:8080/mybuddy2.0/index.php?page=home';
</script>";
//header('Location:http://localhost:8080/webshop/index.php?page=home');