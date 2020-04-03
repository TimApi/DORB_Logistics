<?php
require('database/db.php');

$statement = $conn->prepare("SELECT T.truck_id, T.name, T.amount,T.description, C.category_name  FROM trucks T  LEFT JOIN category C ON T.category_id = C.category_id");
$statement->execute(array(
        ':u_id' => $_SESSION['userid']
    )
);
    if (isset($_SESSION['alertsucces'])) {
        echo '<div class="alert alert-success">' . ($_SESSION['alertsucces']) . '</div>';
    }
unset($_SESSION['alertsucces']);

if (isset($_SESSION['meldingdanger'])) {
    echo '<div class="alert alert-danger">' . ($_SESSION['meldingdanger']) . '</div>';
}
unset($_SESSION['meldingdanger']);

?>
<link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <div class="container">
        <div class="row">
    <?php if  (isset($_SESSION['Rol']) && $_SESSION['Rol'] == "admin"){  ?>
    <?php
        while($r = $statement->fetch()){ ?>
		<div class="span3">
            <div class="well">
        		<h2 class="muted"><?= $r['name'] ?></h2>
        		<p><span class="label">POPULAIR</span></p>
        		 <img class="card-img-top" src="images/2.png" alt="Card image">
        		<p><?= $r['description'] ?></p>
        		<hr>
        		<h3><?= $r['amount'] ?></h3>
        		<hr>
                <form action="?page=truck_toevoegen" method="POST">
                    <input type="hidden" name="id" value="<?= $r['truck_id'] ?>">
                    <button type="submit" class="btn btn-large">Truck Toevoegen</button>
                </form>
            </div>
        </div>
    <?php } ?>
        </div>
    </div>
<?php }else{
        while($r = $statement->fetch()){ ?>
    <div class="card float-left mycard">
        <img class="card-img-top" src="images/grindplaat.jpg" alt="Card image">
        <div class="card-body">
            <h4 class="card-title"><?= $r['productname'] ?></h4>
            <p class="card-text">€ <?= $r['price'] ?></p>
            <p class="card-text"><?= $r['categoryname'] ?></p>
            <form action="?page=product" method="POST">
                <input type="hidden" name="id" value="<?= $r['product_id'] ?>">
                <button type="submit" class="btn btn-info">Koop</button>
            </form>
        </div>
    </div>
<?php } ?>
   <?php } ?>