<?php
require('../database/db.php');
session_start();


$gebruiker = $_SESSION['userid'];
$price = $_POST['price'];


foreach ($_SESSION["shopping_cart"] as $key ) {
        $sql = "INSERT INTO `cart` (pallet_id, user_id, amount, price) VALUES  ({$key['item_id']}, :user_id, {$key['item_quantity']}, :price)";
        $query = $conn->prepare($sql);

        $query->execute(array(
            ':user_id' => $gebruiker,
            ':price' => $price
        ));
unset($_SESSION["shopping_cart"]);
}
header('Location:../index.php?page=home');
