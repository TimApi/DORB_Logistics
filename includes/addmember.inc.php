<form class="form-horizontal" action="php/addmember.php" method="POST">
    <div class="form-group">
        <label class="control-label col-sm-2" for="email">Email:</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" placeholder="Enter email" name="email">
        </div>
    </div>
        <input type="hidden" name="id" value="<?= $_POST["id"]?>">
        <td> <button type="submit" class="btn btn-primary btn-sm">add user</button></td>
    </form>