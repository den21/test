<?php

require_once 'Users.php';

$users = new Users();
$usersAll = $users->getUsers();
$i = 1;
?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
      integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<table id="myTable" class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Email</th>
        <th scope="col">Country</th>
        <th scope="col">Delete</th>
        <th scope="col">Update</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($usersAll as $item) : ?>
        <tr>
            <th scope="row"><?= $i; ?></th>
            <td><?= $item['name']; ?></td>
            <td><?= $item['email']; ?></td>
            <td><?= $item['country']; ?></td>
            <td><input type='button' style="background: #da1818;
        outline: none;
        border: none;
        padding: 10px 15px;
        border-radius: 4px; cursor: pointer;
        color: #fff;" class="delete_button" id="delete_button<?= $item[0]; ?>" value="delete"
                       onclick="delete_row(this, '<?php echo $item[0]; ?>')">
            </td>
            <form method="get" action="update.php">
                <td>
                    <button name="id" value="<?= $item[0]; ?>">Update</button>
                </td>
            </form>
            <?php $i++; ?>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<h4></h4>


<form method="post" action="add.php">
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" class="form-control" id="" placeholder="Name">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Email address</label>
        <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
               placeholder="Enter email">
    </div>
    <div class="form-group">
        <label for="country">Country</label>
        <input type="text" name="country" class="form-control" id="" placeholder="Enter country">
    </div>
    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
</form>
<script>
    function deleteRow(r) {
        console.log(r);
        var i = r.parentNode.parentNode.rowIndex;
        document.getElementById("myTable").deleteRow(i);
    }

    function delete_row(row, id) {
        //console.log(row);
        var row2delete = row;
        $.ajax
        ({
            type: 'post',
            url: 'delete.php',
            data: {
                delete_row: 'delete_row',
                row_id: id,
            },
            success: function (response) {
                deleteRow(row2delete);

                if (response == "success") {
                    var row = document.getElementById("row" + id);
                    row.parentNode.removeChild(row);

                }
            }
        });
    }
</script>


