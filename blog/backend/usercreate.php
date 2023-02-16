<?php 

require "../dbconnect.php";
require "../QueryBuilder.php";

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = 2;


    $sql = "INSERT INTO users(name, email, password, role) VALUES(:name, :email, :password, :role)";
    $stmt = $conn->prepare($sql);
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
                    <p class="d-inline">User Create</p>
                    <a href="user.php" class="btn btn-sm btn-danger float-end">Cancle</a>
                </div>
                <div class="card-body">
                    <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
                        <div class="mb-3">
                            <label for="name" class="form-label">User Name</label>
                            <input type="text" name="name" id="name" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" id="password" class="form-control">
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary w-100"><i class="fas fa-user-plus me-2"></i>Create User</button>
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