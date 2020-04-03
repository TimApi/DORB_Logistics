<?php
require('../database/db.php');
session_start();

if (isset($_POST["submit"])) {
    $id = $_POST["id"];
    $amount = $_POST['amount'];
    $image = $_POST['image'];


    $sql = "UPDATE trucks SET amount=:amount, image=:image  WHERE truck_id=:truck_id";
    $query = $conn->prepare($sql);


    $query->execute(array(
        ':truck_id' => $id,
        ':amount' => $amount,
        ':image' => $image
    ));

    $url = 'Location:http://localhost:8080/DORB_Logistics/index.php?page=truck_toevoegen';
    header($url);
}


else{
    $url = 'Location:http://localhost:8080/DORB_Logistics/index.php?page=truck_toevoegen';
    header($url);
}

    ?>





