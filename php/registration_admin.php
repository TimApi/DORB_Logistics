<?php
require_once "../database/db.php";
session_start();

    if (isset($_POST["submit"]) & !empty($_POST)) {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $adres = $_POST["adres"];
    $password = $_POST["password"];
    $rol = $_POST["rol"];

$hash = md5($password);

    $sql = "INSERT INTO `users` (email, username, password,rol,adres) VALUES (:email, :username, :password, :rol,:adres)";
    $query = $conn->prepare($sql);


    $query->execute(array(
        ':email' => $email,
        ':username' => $username,
        ':password' => $hash,
        ':rol' => $rol,
        ':adres' => $adres

    ));

}
$url = 'Location:http://localhost:8080/DORB_Logistics/index.php?page=home';
header($url);
?>

