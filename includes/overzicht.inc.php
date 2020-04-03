
<?php
require('database/db.php');



$betalingen = $conn->prepare("SELECT * FROM payment p
LEFT JOIN users u ON p.u_id = u.id  WHERE p.g_id = :gro_id ");
$betalingen->execute(array(
        ':gro_id' => $_POST["id"]
    )



);

$lijst = $conn->prepare("SELECT * FROM groups WHERE gro_id = :gid");

$lijst->execute(array(
    ':gid' => $_POST["id"]

));



echo '<table class="table">
    <thead><tr><th scope="col">#</th><th scope="col">username</th><th scope="col">description</th><th scope="col">amount</th><th scope="col">date</th><th scope="col">deelnemers</th>
    </tr>';

?>

<?php
foreach ($lijst as $lijsten)?>
 <h1><?php echo $lijsten["name"]?></h1>


<?php
    foreach ($betalingen as $betaald) {
    ?>

    <tr>
        <th scope="row">1</th>
        <td>
            <?php echo $betaald["username"] ?></td>
        <td>
            <?php echo $betaald["description"] ?></td>
        <td>
            <?php echo $betaald["amount"] ?></td>
        <td>
            <?php echo $betaald["dates"] ?></td>
        </td>
        <?php
        $statement = $conn->prepare("SELECT d.p_id, p.p_id, u.username FROM debts d 
                                                    LEFT JOIN payment p ON d.p_id = p.p_id 
                                                   LEFT JOIN users u ON d.u_id = u.id WHERE d.g_id = :gid AND d.p_id = :pid");

        $statement->execute(array(
            ':gid' => $_POST["id"],
            ':pid' => $betaald["p_id"]

        ));
        ?>

        <td>
        <?php foreach ($statement as $betaald2) {
            ?>
            <?php echo $betaald2["username"] ?>,
        <?php } ?>
        </td>

    </tr>

    <?php } ?>

<form action="?page=uitgaven" method="POST">
    <input type="hidden" name="id" value="<?= $_POST["id"]?>">
    <button type="submit" class="btn btn-info">Nieuwe payment</button>
</form>

<form action="?page=balanse" method="POST">
    <input type="hidden" name="id" value="<?= $_POST["id"]?>">
    <button type="submit" class="btn btn-info">Balanse</button>
</form>


