<?php
require('../database/db.php');
session_start();


if (isset($_POST["submit"])) {
    $category = $_POST['category'];
    $discription = $_POST['discription'];
    $image = $_POST['image'];
    $palets = $_POST['amount'];
    $kosten = 0;

    if($palets == 1) {
        $kosten = $palets * 0.50;
    }
    else if($palets == 2 || $palets == 3) {
        $kosten = $palets * 0.45;
    }
    else if($palets == 4 || $palets == 5){
        $kosten = $palets * 0.40;
    }
    else if($palets >= 6) {
        $kosten = $palets * 0.35;
    }

    $sql = "INSERT INTO `pallets` (format_id, name, description,image ,amount ,price ) VALUES (:format_id, :name, :description, :image,:amount,:price)";
    $query = $conn->prepare($sql);


    $query->execute(array(
        ':format_id' => $category,
        ':name' => $category,
        ':description' => $discription,
        ':image' => $image,
        ':amount' => $palets,
        ':price' => $kosten,

    ));

    $url = 'Location:http://localhost:8080/DORB_Logistics/index.php?page=home';
    header($url);

}
else{

    $url = 'Location:http://localhost:8080/DORB_Logistics/index.php?page=pallets_toevoegen';
    header($url);
}

    ?>





