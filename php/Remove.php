
<?php
session_start();

if(isset($_POST['id'])) {
    foreach ($_SESSION["shopping_cart"] as $keys => $values) {
        if ($values["item_id"] == $_POST["id"]) {
            unset($_SESSION["shopping_cart"][$keys]);
            echo '<script>alert("Item Removed")</script>';
            echo '<script>window.location="http://localhost:8080/DORB_Logistics/?page=shopping_cart"</script>';

        }
    }
}

