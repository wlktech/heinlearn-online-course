<?php 
include "../DB.php";
include "../QueryBuilder.php";

$db = new DB();
$connection = $db->connect();
$query = new QueryBuilder($connection);

$id = $_GET['id'];
$user = $query->get("users", "*", $id);

include "../header.php";
?>
    <div class="container mt-5 pt-5">
        <h3 class="text-center">Edit User</h3>
        
        <form action="../controllers/UserController.php" method="post">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" name="name" id="name" value="<?php echo $user['name'] ?>">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" id="email" value="<?php echo $user['email'] ?>">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="password" value="<?php echo $user['password'] ?>">
            </div>
            <input type="hidden" name="action" value="update">
            <input type="hidden" name="id" value="<?php echo $user['id'] ?>">
            <div class="mb-3 text-end">
                <button class="btn btn-primary" type="submit">Edit</button>
            </div>
        </form>
    </div>

<?php 
include "../footer.php";
?>