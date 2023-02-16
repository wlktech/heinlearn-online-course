<?php 
include "../dbconnect.php";
include "../QueryBuilder.php";

$users = select("users", "*", $conn);
if(isset($_POST['id'])){
    $id = $_POST['id'];
    delete("users", $id, $conn);
    header("location: user.php");
}

include "header.php";
include "nav.php";

?>

            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <div class="card my-4">
                            <div class="card-header">
                                <p class="d-inline">User Lists</p>
                                <a href="./usercreate.php" class="btn btn-primary btn-sm float-end">User Create</a>
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th style="width:100px">#</th>
                                            <th style="width:400px">Name</th>
                                            <th style="width:400px">Email</th>
                                            <th style="width:200px">Action</th>
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
                                            
                                            <td>
                                                
                                                <a class="btn btn-sm" href="userupdate.php?id=<?php echo $user['id'] ?>"><i class="fas fa-user-pen text-success"></i></a>
                                                <button class="btn btn-sm delete_id" data-id="<?php echo $user['id'] ?>" data-bs-toggle="modal" data-bs-target="#deleteModal"><i class="fas fa-user-minus text-danger"></i></button>
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
include "userdeletemodal.php";
include "footer.php";