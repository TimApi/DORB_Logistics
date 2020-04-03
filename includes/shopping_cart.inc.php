<?php
require('database/db.php');

$total = 0;


if(isset($_POST["add_to_cart"]))
{
    if(isset($_SESSION["shopping_cart"]))
    {
        $item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
        if(!in_array($_POST["id"], $item_array_id))
        {
            $count = count($_SESSION["shopping_cart"]);
            $item_array = array(
                'item_id'               =>     $_POST["id"],
                'item_name'               =>     $_POST["name"],
                'item_price'          =>     $_POST["price"],
                'item_quantity'          =>     $_POST["amount"]
            );
            $_SESSION["shopping_cart"][$count] = $item_array;
        }
        else
        {
            echo '<script>alert("Item Already Added")</script>';
            echo '<script>window.location="index.php"</script>';
        }
    }
    else
    {
        $item_array = array(
            'item_id'               =>     $_POST["id"],
            'item_name'               =>     $_POST["name"],
            'item_price'          =>     $_POST["price"],
            'item_quantity'          =>     $_POST["amount"]
        );
        $_SESSION["shopping_cart"][0] = $item_array;
    }
}



?>


<head>
    <title>Webslesson Tutorial | Simple PHP Mysql Shopping Cart</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>


<div class="container">
<div class="row">
    <div class="col-xs-10">
        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="panel-title">
                    <div class="row">
                        <div class="col-xs-6">
                            <h5><span class="glyphicon glyphicon-shopping-cart"></span> Shopping Cart</h5>
                        </div>
                        <form action="?page=home" method="POST">
                        <div class="col-xs-12">
                            <button type="submit" class="btn btn-primary btn-sm btn-block">
                                <span class="glyphicon glyphicon-share-alt"></span> Continue shopping
                            </button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="panel-body">
        <?php
        if(!empty($_SESSION["shopping_cart"]))
        {

                foreach($_SESSION["shopping_cart"] as $keys => $values)
            {

                $palets = $values['item_quantity'];
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

                ?>

                    <div class="row">
                        <div class="col-xs-2"><img class="img-responsive" src="http://placehold.it/100x70">
                        </div>
                        <div class="col-xs-4">
                            <h4 class="product-name"><strong><?php echo $values["item_name"]; ?></strong></h4><h4><small>Product description</small></h4>
                        </div>
                        <div class="col-xs-6">
                            <div class="col-xs-6 text-right">
                                <h6><strong><?php echo $kosten; ?><span class="text-muted">x</span></strong></h6>
                            </div>
                            <div class="col-xs-4">
                                <input type="text"  class="form-control input-sm" readonly value="<?= $palets ?>">
                                <div class="col-xs-2">
                                    <form id="form1" name="form1" method="POST" action="php/Remove.php">
                                        <div class="col-xs-2">
                                            <button type="submit" class="btn btn-link btn-xs">
                                                <span class="glyphicon glyphicon-trash"> </span>
                                            </button>
                                        </div>
                                        <input name="id" type="hidden" id="id" value="<? echo $values['item_id']; ?>" />
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                $total = $total + ($palets * $kosten);
            }
            ?>
                    <div class="row">
                        <div class="text-center">
                            <div class="col-xs-9">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <div class="row text-center">
                        <div class="col-xs-9">
                            <h4 class="text-right">Total <strong>$ <?php echo number_format($total, 2); ?></strong></h4>
                        </div>
                        <div class="col-xs-3">
                            <form action="php/winkelmandje.php" method="POST">
                                <input type="hidden" name="amount" value="<?= $palets?>">
                                <input type="hidden" name="name" value="<?= $values['item_name'] ?>">
                                <input type="hidden" name="price" value="<?= $total?>">
                                <input type="hidden" name="add_to_cart">
                                <button type="submit" onclick="show_alert();"  class="btn btn-success btn-block">
                                    Checkout
                                </button>
                            </form>
            <?php
        }
        ?>
        </div>
    </div>
</div>
</div>