<?php
require('database/db.php');


$id = $_POST['id'];
$statement = $conn->prepare("SELECT T.truck_id, T.name, T.amount,T.description, C.category_name  FROM trucks T LEFT JOIN category C ON T.category_id = C.category_id  WHERE T.truck_id = :truck_id");
$statement->execute(array(
    ':truck_id' => $id
));



?>
<?php while($r = $statement->fetch()){ ?>
<div class="container">
    <div class="d-flex justify-content-center h-100">
        <div class="card">
            <div class="card-header">
                <h3>Truck toevoegen</h3>
            </div>
            <div class="card-body">
                <form class="form-horizontal" action="php/truck_toevoegen.php" method="POST">
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="text" name="name" value="<?php  echo $r["name"] ?>"class="form-control" readonly>
                    </div>
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                        </div>
                        <input type="text" name="amount" value="<?php  echo $r["amount"] ?>" class="form-control" >
                    </div>
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="file" class="form-control" value="" accept="image/*" placeholder="Enter Product Image" name="image" >
                    </div>
                    <input type="hidden"value="<?= $r['truck_id'] ?>" name="id">
                    <input type="submit" name="submit"  value="Add" class="btn float-right login_btn">
                        </div>
                    </div>
                </form>
            </div>
            </div>
        </div>
    </div>
<?php } ?>
