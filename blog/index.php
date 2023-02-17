<?php
include "navbar.php";
?>
<?php
require "QueryBuilder.php";
require "dbconnect.php";
$categories = select('categories', '*', $conn);
$posts = select("posts", "*", $conn);
// var_dump($posts);

?>


<!-- Page header with logo and tagline-->
<header class="py-5 bg-light border-bottom mb-4">
    <div class="container">
        <div class="text-center my-5">
            <h1 class="fw-bolder">Welcome to WLK Blog!</h1>
            <p class="lead mb-0">Learning is a kind of equipment to face the life battle, Knowledge comes from past.</p>
        </div>
    </div>
</header>
<!-- Page content-->
<div class="container">
    <div class="row">
        <!-- Blog entries-->
        <div class="col-lg-8">
            <div class="row">
            <?php
                foreach($posts as $post) {
                ?>
                <div class="col-lg-12">
                    <!-- Featured blog post-->
                    <div class="card mb-4">
                        <a href="#!">
                            <img class="card-img-top" src="backend/<?php echo $post['image'] ?>"  alt="..." />
                        </a>
                        <div class="card-body">
                            <div class="small text-muted">
                                <?php echo $post['posted_date'] ?>
                            </div>
                                <h2 class="card-title">
                                    <?php echo $post['title'] ?>
                                </h2>
                                <p class="card-text" align="justify">
                                    <?php 
                                    echo substr($post["description"], 0,200) 
                                    ?>
                                </p>
                                <a class="btn btn-primary" href="#!">Read more →</a>
                        </div>
                    </div>
                </div>
                <?php
                }
                ?>
            </div>
        </div>
        
        
        <!-- Side widgets-->
        <div class="col-lg-4">
            <!-- Categories widget-->
            <div class="card mb-4">
                <div class="card-header">Categories</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <ul class="list-unstyled mb-0">
                                    <?php foreach($categories as $category){ ?>
                                        <li><a href="#!"><?php echo $category['category_name'] ?></a></li>
                                    <?php } ?>
                                </ul>
                            </div>    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include "footer.php";
?>

