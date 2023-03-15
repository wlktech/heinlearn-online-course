<?php 
session_start();
if(isset($_SESSION['user_id'])){
include "../dbconnect.php";
include "../QueryBuilder.php";

$cols = "posts.*, category_name as c_name, users.name as u_name";
$join = "INNER JOIN categories on posts.categories_id=categories.id INNER JOIN users on posts.created_by=users.id";
$where = null;
$order = "id DESC";

$posts = selectJoins("posts", $cols, $join, $where, $order, $conn);
if(isset($_POST['id'])){
    $id = $_POST['id'];
    delete("posts", $id, $conn);
    header("location: post.php");
}

include "header.php";
include "nav.php";

?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <div class="card my-4">
                            <div class="card-header">
                                <p class="d-inline">Post Lists</p>
                                <a href="postcreate.php" class="btn btn-primary btn-sm float-end">Post Create</a>
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Title</th>
                                            <th>Category</th>
                                            <th>Created By</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <!-- <tfoot>
                                        <tr>
                                            <th>Name</th>
                                            <th>Position</th>
                                            <th>Office</th>
                                            <th>Age</th>
                                            <th>Start date</th>
                                            <th>Salary</th>
                                        </tr>
                                    </tfoot> -->
                                    <tbody>
                                        <?php 
                                        $no = 1;
                                        foreach($posts as $post){
                                        ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $post['title'] ?></td>
                                            <td><?= $post['c_name'] ?></td>
                                            <td><?= $post['u_name'] ?></td>
                                            <td>
                                                <a class="btn btn-sm" href="updatepost.php?id=<?php echo $post['id'] ?>"><i class="fas fa-pen-to-square text-success"></i></a>
                                                
                                                <button class="btn btn-sm delete_id" data-id="<?php echo $post['id'] ?>" data-bs-toggle="modal" data-bs-target="#deleteModal"><i class="fas fa-trash text-danger"></i></button>
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
include "postdeletemodal.php";
include "footer.php";

}else{
    header("location: login.php");
}
?>