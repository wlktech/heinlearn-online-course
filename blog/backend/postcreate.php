<?php 

require "../dbconnect.php";
require "../QueryBuilder.php";

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $title = $_POST['title'];
    $image_arr = $_FILES['image'];
    $categories_id = $_POST['categories_id'];
    $description = $_POST['description'];
    // echo $title, $category_id, $description;
    // print_r($image_arr);

    if(isset($image_arr) && $image_arr['size']>0){
        $dir = "images/";
        $image = $dir.$image_arr['name'];
        $tmp_name = $image_arr['tmp_name'];
        move_uploaded_file($tmp_name, $image);
    }

    // $posted_date = date("Y-m-d");
    // $created_by = 2;
    // $updated_by = 2;


    // $sql = "INSERT INTO posts(title, image, description, categories_id, posted_date, created_by, updated_by) VALUES(:title, :image, :description, :categories_id, :posted_date, :created_by, :updated_by)";
    // $stmt = $conn->prepare($sql);
    // $stmt->bindParam(":title", $title);
    // $stmt->bindParam(":image", $image);
    // $stmt->bindParam(":description", $description);
    // $stmt->bindParam(":categories_id", $categories_id);
    // $stmt->bindParam(":posted_date", $posted_date);
    // $stmt->bindParam(":created_by", $created_by);
    // $stmt->bindParam(":updated_by", $updated_by);
    // $stmt->execute();

    // header("location: post.php");

    $datas = [
        "title" => $title,
        "image" => $image,
        "description" => $description,
        "categories_id" => $categories_id,
        "posted_date" => date("Y-m-d"),
        "created_by" => 2,
        "updated_by" => 2
    ];
    // $column_names = implode("," , array_keys($datas));
    // echo $column_names;



    store("posts", $datas, $conn);
    header("location: post.php");


}else{

    include "header.php";
    include "nav.php";
?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-3 mt-5">
            <div class="card">
                <div class="card-header">
                    <p class="d-inline">Post Create</p>
                    <a href="post.php" class="btn btn-sm btn-danger float-end">Cancle</a>
                </div>
                <div class="card-body">
                    <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="title" class="form-label">Post Title</label>
                            <input type="text" name="title" id="title" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Post Photo</label>
                            <input type="file" name="image" id="image" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" id="description" cols="30" rows="10" class="form-control"></textarea>
                        </div>
                        <!-- <div class="mb-3">
                            <label for="posted_date" class="form-label">Posted Date</label>
                            <input type="date" name="posted_date" id="posted_date" class="form-control">
                        </div> -->
                        <div class="mb-3">
                            <label for="posted_date" class="form-label">Category</label>
                            <select class="form-select mb-3" name="categories_id">
                                <option selected>Select Category</option>
                                <?php $categories = select("categories", "*", $conn);
                                foreach($categories as $category){ ?>
                                <option value="<?php echo $category['id'] ?>"><?php echo $category['category_name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary w-100">Submit</button>
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