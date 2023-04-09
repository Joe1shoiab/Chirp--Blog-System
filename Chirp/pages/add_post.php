<?php
session_start();

// Include the database connection and Post class
include_once('../config/database.php');
include_once('../classes/post.php');

include('../includes/header.php');
include('../includes/navbar.php');



// Check if the form has been submitted
if (isset($_POST['add'])) {
    // Create a new Post object and 
    $post = new Post($pdo);
    $result = $post->createPost($_POST['title'], $_POST['content'], $_SESSION['user_id']);

     

    if ($result)
    {
        header('Location: ../index.php');
        exit;
    }
    else {
        echo 'An error occurred while creating the post.';
    }
}

?>

<section class="text-center">
    <!-- Background image -->
    <div class="p-5 bg-image" style="
        background-image: url('https://mdbootstrap.com/img/new/textures/full/171.jpg');
        height: 300px;
        "></div>
    <!-- Background image -->

    <div class="card mx-4 mx-md-5 shadow-5-strong" style="
        margin-top: -100px;
        background: hsla(0, 0%, 100%, 0.8);
        backdrop-filter: blur(30px);
        ">
        <div class="card-body py-5 px-md-5">

            <div class="row d-flex justify-content-center">
                <div class="col-lg-8">
                    <h2 class="fw-bold mb-5">Add Post</h2>
                    <form method="post">
                        <!-- Title input -->
                        <div class="form-outline mb-4">
                            <label class="form-label" for="form3Example3">Title</label>
                            <input name="title" type="text" id="form3Example3" class="form-control" />
                        </div>

                        <!-- Content input -->
                        <div class="form-outline mb-4">
                            <label class="form-label" for="form3Example4">Content</label>
                            <textarea name="content" type="content" id="form3Example4" class="form-control"
                                required></textarea>
                        </div>



                        <!-- add button -->
                        <button name="add" type="submit" class="btn btn-primary btn-block mb-4">
                            Add Post
                        </button>


                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- HTML form for adding a new post -->