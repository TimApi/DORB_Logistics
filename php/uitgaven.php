<?php
require_once "../database/db.php";
session_start();

$amount = $_POST['amount'];
$description = $_POST['description'];
$startdate = $_POST["datum"];
$user = $_POST["user"];


$sql = "INSERT INTO payment (g_id, u_id, amount, description, dates) VALUES (:gid, :uid, :amount, :description, :dates)";
$query = $conn -> prepare($sql);


$query -> execute(array(
    ':gid' => $_POST["id"],
    ':uid' => $user,
    ':amount' => $amount,
    ':description' => $description,
    ':dates' => $startdate,

));


$lastid = $conn->lastInsertId();



for ($i = 0; $i < count($_POST['debtamount']); $i++) {
    $newdebt = $conn->prepare('INSERT INTO debts(p_id, g_id, u_id, amount)
                                         VALUES (:pid, :gid, :uid, :debtamount)');
    $newdebt->execute(array(
        ':pid' => $lastid,
        ':gid' => $_POST["id"],
        ':uid' => $_POST['debtuserid'][$i],
        ':debtamount' => $_POST['debtamount'][$i]
    ));
}

header('location:../?page=overzicht');
echo "<script>
alert('succesful');
window.location.href='http://localhost:8080/mybuddy2.0/index.php?page=login';
</script>";
//header('Location:http://localhost:8080/webshop/index.php?page=login');



