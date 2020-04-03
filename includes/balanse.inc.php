<?php
require('database/db.php');

$select = $conn->prepare("SELECT u.id, username, d.amount AS debtsum FROM users u 
                                    INNER JOIN debts d ON d.u_id = u.id WHERE d.g_id = :id GROUP BY u.id");
$select->execute(array(
    ":id" => $_POST['id']
));

?>
 <table class="table table-bordered" id="membertable">
        <thead>
        <tr>
            <th>Who</th>
            <th>Payment</th>
            <th>Costs</th>
            <th>Saldo</th>
        </tr>
        </thead>

<?php

    foreach ($select

    as $data) {
    $memberdebt = $conn->prepare('SELECT  SUM(amount) AS sumdebtamount FROM debts d
    LEFT JOIN users u ON d.u_id = u.id WHERE g_id = :gid AND d.u_id = :duid');
    $memberdebt->execute(array(
    ':gid' => $_POST['id'],
    ':duid' => $data['id']
    ));
    $debtmember = $memberdebt->fetch();

    $memberpaymentfetch = $conn->prepare('SELECT *, SUM(amount) AS sumpaymentamount FROM payment WHERE g_id = :gid AND u_id = :uid');
    $memberpaymentfetch->execute(array(
    ':gid' => $_POST['id'],
    ':uid' => $data['id']
    ));
    $fetch = $memberpaymentfetch->fetch();

    $memberpayment = $conn->prepare('SELECT *, SUM(amount) AS sumpaymentamount FROM payment WHERE g_id = :gid AND u_id = :uid');
    $memberpayment->execute(array(
    ':gid' => $_POST['id'],
    ':uid' => $data['id']
    ));
    ?>
    <tr>
        <td><?= $data['username'] ?></td>
        <?php if ($fetch['amount']== 0) { ?>
            <td>0</td>
        <?php } else { ?>
            <?php foreach ($memberpayment as $row) { ?>
                <td><?= $row['sumpaymentamount'] ?></td>
                <?php $_SESSION['balance'] = $row['sumpaymentamount'] ?>
            <?php } ?>
        <?php } ?>
        <td><?= $debtmember['sumdebtamount'] ?></td>
        <?php if (isset($_SESSION['balance'])) { ?>
            <?php $totalbalance = $_SESSION['balance'] - $debtmember['sumdebtamount'];
        } else {
            $totalbalance = 0 - $data['amount'];
        } ?>
        <td><?= $totalbalance ?></td>
        <?php unset($_SESSION['balance']) ?>
    </tr>
<?php } ?>

