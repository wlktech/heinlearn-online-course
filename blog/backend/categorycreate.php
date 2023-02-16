<?php 

require "../dbconnect.php";
require "../QueryBuilder.php";

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $category_name = $_POST['category_name'];


    $sql = "INSERT INTO categories(category_name) VALUES(:category_name)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":category_name", $category_name);
    $stmt->execute();

    header("location: category.php");


}else{

    include "header.php";
    include "nav.php";
?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-3 mt-5">
            <div class="card">
                <div class="card-header">
                    <p class="d-inline">Category Create</p>
                    <a href="category.php" class="btn btn-sm btn-danger float-end">Cancle</a>
                </div>
                <div class="card-body">
                    <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
                        <div class="mb-3">
                            <label for="category_name" class="form-label">Category Name</label>
                            <input type="text" name="category_name" id="category_name" class="form-control">
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary w-100"><i class="fas fa-plus me-2"></i>Create Categories</button>
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