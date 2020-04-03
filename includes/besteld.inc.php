<?php
require('database/db.php');

$gebruiker = $_SESSION['userid'];

$statement = $conn->prepare("SELECT C.pallet_id, C.amount, C.user_id, C.amount, C.price, U.adres  FROM cart C  LEFT JOIN users U ON C.user_id = U.id WHERE user_id = :user_id");
$statement->execute(array(
        ':user_id' => $gebruiker
    )
);

?>

<div class="container">
    <?php if  (isset($_SESSION['Rol']) && $_SESSION['Rol'] == "lid"){  ?>

    <table class="table table-dark">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">name</th>
            <th scope="col">amount</th>
            <th scope="col">price</th>
            <th scope="col">adres</th>
        </tr>
        </thead>
        <tbody>
        <tr>
        <?php

        while($r = $statement->fetch()){ ?>
            <th scope="row">1</th>
            <td><?php echo $r ["pallet_id"]?>
            <td><?php echo $r ["amount"]?></td>
            <td><?php echo $r ["price"]?></td>
            <td><?php echo $r ["adres"]?></td>
        <tr>
        <?php } ?>
    <?php } ?>
  </div>
