<?php
require('database/db.php');

   $statement = $conn->prepare("SELECT P.pallet_id, P.name, P.amount,P.description,P.price, F.format_size  FROM pallets P  LEFT JOIN format F ON P.format_id = F.format_id");
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
            <form action="?page=pallets_toevoegen" method="POST">
                <input type="hidden" name="id" value="">
                <button type="submit" class="btn btn-large">Pallets Toevoegen</button>
            </form>
            <?php
            while($r = $statement->fetch()){ ?>
                <div class="span3">
                    <div class="well">
                        <h2 class="muted"><?= $r['name'] ?></h2>
                        <p><span class="label">€<?= $r['price'] ?></span></p>
                        <img class="card-img-top" src="images/pallets.jpg" alt="Card image">
                        <p><?= $r['description'] ?></p>
                        <hr>
                        <h3><?= $r['amount'] ?></h3>
                        <hr>
                        <form action="?page=pallets_toevoegen" method="POST">
                            <input type="hidden" name="id" value="">
                            <button type="submit" class="btn btn-large">Pallets Toevoegen</button>
                        </form>
                    </div>
                </div>
    <?php } ?>
        </div>
    </div>
<?php }else{  ?>
   <div class="container">
        <div class="row">
         <?php
            while($r = $statement->fetch()){ ?>
                <div class="span3">
                    <div class="well">
                        <h2 class="muted"><?= $r['name'] ?></h2>
                        <p><span class="label">€<?= $r['price'] ?></span></p>
                        <img class="card-img-top" src="images/pallets.jpg" alt="Card image">
                        <p><?= $r['description'] ?></p>
                        <hr>
                        <h3> Vooraad <?= $r['amount'] ?></h3>
                        <hr>
                        <form action="?page=shopping_cart" method="POST">
                            <input type="hidden" name="id" value="<?= $r['pallet_id'] ?>">
                            <input type="hidden" name="name" value="<?= $r['name'] ?>">
                            <input type="text" name="amount" value="0" class="form-control" />
                            <input type="hidden" name="price" value="<?= $r['price'] ?>">
                            <input type="hidden" name="image" value="<?= $r['image'] ?>">
                            <input type="hidden" name="add_to_cart">
                            <button type="submit" class="btn btn-large">Pallets Kopen</button>
                        </form>
                    </div>
                </div>
<?php } ?>
        </div>
   </div>
   <?php } ?>