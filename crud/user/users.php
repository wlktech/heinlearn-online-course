<?php
include "../DB.php";
include "../QueryBuilder.php";

$db = new DB();
$connection = $db->connect();
$query = new QueryBuilder($connection);

$users = $query->getAll("users", "*");

include "../header.php";
?>

<div class="container mt-5 pt-5">
    <a href="createUser.php" class="btn btn-sm btn-primary">Create</a>
    <a href="updateUser.php" class="btn btn-sm btn-primary">Edit</a>

    <h3 class="text-center">User Lists</h3>
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Password</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $no = 1;
            foreach($users as $user){
            ?>
            <tr>
                <td><?php echo $no++ ?></td>
                <td><?php echo $user['name'] ?></td>
                <td><?php echo $user['email'] ?></td>
                <td><?php echo $user['password'] ?></td>
                <td>
                    <a href="updateUser.php?id=<?php echo $user['id'] ?>" class="btn btn-sm btn-success">Edit</a>
                    <a href="../controllers/UserController.php?action=delete&id=<?php echo $user['id'] ?>" class="btn btn-sm btn-danger">Delete</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>


<?php 
include "../footer.php";
?>