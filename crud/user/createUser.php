<?php 


include "../header.php";
?>
    <div class="container mt-5 pt-5">
        <h3 class="text-center">Create User</h3>
        <!-- <img src="" alt=""> -->
        <form action="../controllers/UserController.php" method="POST" enctype="multipart/form-data" class="my-5">
            <input type="file" name="image" placeholder="image">
            <input type="hidden" name="action" value="uploadImage">
            <button class="btn btn-sm btn-primary">Set Profile</button>
        </form>

        <div class="dropzone-previews"></div>

        <form action="../controllers/UserController.php" method="post">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" name="name" id="name">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" id="email">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="password">
            </div>
            <input type="hidden" name="action" value="add">
            <div class="mb-3 text-end">
                <button class="btn btn-primary" type="submit">Create</button>
            </div>
        </form>
    </div>

<?php 
include "../footer.php";
?>