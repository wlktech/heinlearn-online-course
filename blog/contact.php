<?php 
include "navbar.php";
?>
<!-- Page header with logo and tagline-->
<header class="py-5 bg-light border-bottom mb-4">
    <div class="container">
        <div class="text-center my-3">
            <h1 class="fw-bolder">Contact Me</h1>
        </div>
        <div class="row">
            <div class="col-md-6 p-5">
            <iframe class="rounded shadow" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3818.383078798053!2d96.16870831418024!3d16.856934122324954!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30c193631e318d6b%3A0x989fcb3a2b8b438c!2sWLK-TECH!5e0!3m2!1sen!2smm!4v1675958926778!5m2!1sen!2smm" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            <div class="col-md-6 p-5">
                <form action="">
                    <input type="text" class="form-control mb-3" name="name" placeholder="Enter Your Name">
                    <input type="email" class="form-control mb-3" name="email" placeholder="Enter Your Email">
                    <textarea name="comment" id="" cols="30" rows="10" class="form-control mb-3" placeholder="Leave a comment"></textarea>
                    <button class="btn btn-outline-dark">Submit</button>
                </form>
            </div>
        </div>
        
    </div>
</header>




<?php 
include "footer.php";
?>