<?php 
include "dbconnect.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $task = $_POST['task'];
    // echo $task;

    $status = 0;
    $sql = "INSERT INTO lists(task, status) VALUES(:task, :status)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":task", $task);
    $stmt->bindParam(":status", $status);
    $stmt->execute();
    header("location:".$_SERVER["HTTP_REFERER"]);
}else{




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ToDo List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

</head>
<body>
<div class="container my-3">
    <h1 class="text-center">ToDo Lists</h1>
    <div class="row">
        <div class="offset-md-3 col-md-6">
            <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
                <div class="row my-4">
                    <div class="col-md-8">
                        <div class="mb-3">
                            <input type="text" class="form-control" id="task" placeholder="Enter Task" name="task">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <button class="btn btn-primary">Add Task</button>
                    </div>
                </div>
            </form>

            <table class="table my-5">
                <?php 
                $sql = "SELECT * FROM lists";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $lists = $stmt->fetchAll();

                $i = 1;
                foreach($lists as $list){ ?>

                <tr>
                    <td><?php echo $i++ ?></td>
                    <td class="<?php if($list['status'] == 1) echo 'text-decoration-line-through' ?>"><?php echo $list['task'] ?></td>
                    <td>
                        <form class="d-inline" action="done.php" method="post">
                            <input type="hidden" name="task_id" value="<?php echo $list['id'] ?>">
                            <button class="btn btn-sm btn-success"><i class="fas fa-check"></i></button>
                        </form>
                        
                        <button class="btn btn-sm btn-warning task_edit" data-id="<?php echo $list['id'] ?>" data-task="<?php echo $list['task'] ?>" data-bs-target="#editModal"><i class="fas fa-pen"></i></button>
                        <button class="btn btn-sm btn-danger task_del" data-bs-toggle="modal" data-id="<?php echo $list['id'] ?>" data-bs-target="#deleteModal"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
                <?php
                }
                ?>
            </table>
        </div>
    </div>
</div>  




<script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/b829c5162c.js" crossorigin="anonymous"></script>
<script>
    $(document).ready(function () {
        //task_delete
        $('.task_del').click(function(){
            $id = $(this).data('id');
            $('#task_id').val($id);
            $('#deleteModal').modal('show');
        })

        //task_edit
        $('.task_edit').click(function(){
            $id = $(this).data('id');
            $task = $(this).data('task');
            $('#edit_task').val($task);
            $('#edit_id').val($id)
            $('#editModal').modal('show');
            
        })
    });
</script>
</body>
</html>

<?php 

}
?>

<!--Delete Modal -->
<div class="modal modal-md fade" id="deleteModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-danger">
        <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">Delete Task</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <h3 class="text-center py-3">Are you sure Delete?</h3>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <form action="delete_task.php" method="post">
            <input type="hidden" id="task_id" name="task_id" value="">
            <button type="submit" class="btn btn-danger">Delete</button>
        </form> 
        
      </div>
    </div>
  </div>
</div>

<!--Edit Modal -->
<div class="modal modal-md fade" id="editModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-light">
        <h1 class="modal-title fs-5 text-dark" id="exampleModalLabel">Task Edit</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- <h5 class="text-center py-3">Edit Task</h5> -->
        <form action="update_task.php" method="post">
                <div class="row my-4">
                    <div class="col-md-8">
                        <div class="mb-3">
                            
                            <input type="text" class="form-control" id="edit_task" placeholder="Enter Task" name="task">
                            <input type="hidden" name="task_id" id="edit_id" value="">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <button class="btn btn-warning" type="submit">Update Task</button>
                    </div>
                </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>