<?php 
session_start();
if(isset($_SESSION['user_id'])){
include "../dbconnect.php";
include "../QueryBuilder.php";

$categories = select("categories", "*", $conn);
if(isset($_POST['id'])){
    $id = $_POST['id'];
    delete("categories", $id, $conn);
    header("location: category.php");
}

include "header.php";
include "nav.php";

?>

            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <div class="card my-4">
                            <div class="card-header">
                                <p class="d-inline">Category Lists</p>
                                <a href="./categorycreate.php" class="btn btn-primary btn-sm float-end">Category Create</a>
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th style="width:100px">#</th>
                                            <th style="width:400px">Name</th>
                                            <th style="width:200px">Action</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        <?php 
                                        $no = 1;
                                        foreach($categories as $category){
                                        ?>
                                        <tr>
                                            <td><?php echo $no++ ?></td>
                                            <td><?php echo $category['category_name'] ?></td>
                                            
                                            <td>
                                                <a href="categoryupdate.php?id=<?php echo $category['id'] ?>"><i class="fas fa-pen-to-square me-2 text-success"></i></a>
                                                <button class="btn btn-sm delete_id" data-id="<?php echo $category['id'] ?>" data-bs-toggle="modal" data-bs-target="#deleteModal"><i class="fas fa-trash text-danger"></i></button>
                                                
                                            </td>
                                        </tr>
                                        <?php }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2022</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        
<?php 
include "categorydeletemodal.php";
include "footer.php";
}else{
    header("location: login.php");
}
?>