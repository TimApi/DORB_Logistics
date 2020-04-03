
<?php
require('../database/db.php');
session_start();


$naam = $_POST['name'];
$startdate = date("Y-m-d");



$sql = "INSERT INTO `groups` (name, datestart) VALUES (:name, :datestart)";
$query = $conn -> prepare($sql);


$query -> execute(array(
    ':name' => $naam,
    ':datestart' => $startdate,



));

$conn->exec($query);
$lastid = $conn->lastInsertId();

$ownergroup = $conn->prepare('INSERT INTO members (u_id, g_id, owner)
                                        VALUES (:uid, :gid, :owner)');
$ownergroup->execute(array(
    ':uid' => $_SESSION['userid'],
    'gid' => $lastid,
    ':owner' => 1
));


echo "<script>
alert('succesful');
window.location.href='http://localhost:8080/mybuddy2.0/index.php?page=home';
</script>";
//header('Location:http://localhost:8080/webshop/index.php?page=home');
