<?php
require('../database/db.php');


$id = $_POST["id"];

$sql = "DELETE FROM trucks WHERE truck_id = :id";
$query = $conn -> prepare($sql);


$query -> execute(array(
    ':id' => $id
));

$url = 'Location:http://localhost:8080/DORB_Logistics/index.php?page=trucks';
header($url);


