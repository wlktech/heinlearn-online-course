<?php 

require "../dbconnect.php";
require "../QueryBuilder.php";

$id = $_GET['id'];

$user = selectone("users", "*", $id, $conn);

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = 2;


    $sql = "UPDATE users SET name=:name, email=:email, password=:password, role=:role WHERE id=:id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":id", $id);
    $stmt->bindParam(":name", $name);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":password", $password);
    $stmt->bindParam(":role", $role);
    $stmt->execute();

    header("location: user.php");


}else{

    include "header.php";
    include "nav.php";
?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-3 mt-5">
            <div class="card">
                <div class="card-header">
                    <p class="d-inline">User Edit</p>
                    <a href="user.php" class="btn btn-sm btn-danger float-end">Cancle</a>
                </div>
                <div class="card-body">
                    <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
                        <div class="mb-3">
                            <label for="name" class="form-label">User Name</label>
                            <input type="text" name="name" id="name" class="form-control" value="<?php echo $user['name'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control" value="<?php echo $user['email'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" id="password" class="form-control" value="<?php echo $user['password'] ?>">
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary w-100"><i class="fas fa-user-plus me-2"></i>Edit User</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

<?php 
include "footer.php";
}
?>