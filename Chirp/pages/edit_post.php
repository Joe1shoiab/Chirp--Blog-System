<?php
session_start();

include_once('../config/database.php');
include_once('../classes/post.php');
include('../includes/header.php');
include('../includes/navbar.php');


if (isset($_GET['id'])) {
    $postobj1 = new Post($pdo);

    if ($postobj1->readPost($_GET['id'])) {
        $post = $postobj1->readPost($_GET['id']);
        $title =$post['title'];
    }
}


if (isset($_POST['edit'])) {
    $postobj2 = new Post($pdo);

    if ($postobj2->update($_POST['title'], $_POST['content'], $_GET['id'])) {
        header('Location: ../index.php');
        exit;
    }
    else
    {
        echo 'An error occurred while creating the post.';
    }
}


if ($_SESSION['user_id'] != $post['user_id']) {
    header('Location: /chirp/index.php');
}



?>

<section class="text-center">
<!-- Background image -->
<div class="p-5 bg-image" style="
background-image: url('https://mdbootstrap.com/img/new/textures/full/171.jpg');
height: 300px;
"></div>

<div class="card mx-4 mx-md-5 shadow-5-strong" style="
margin-top: -100px;
background: hsla(0, 0%, 100%, 0.8);
backdrop-filter: blur(30px);
">
<div class="card-body py-5 px-md-5">

<div class="row d-flex justify-content-center">
<div class="col-lg-8">
<h2 class="fw-bold mb-5">Edit Post</h2>
<form method="post">

<div class="form-outline mb-4">
<label class="form-label" for="form3Example3">Title</label>
<input value=<?= $title ?> name="title" type="text" id="form3Example3" class="form-control" />
</div>

<div class="form-outline mb-4">
<label class="form-label" for="form3Example4">Content</label>
<textarea name="content" type="password" id="form3Example4" class="form-control"
required><?= $post['content'] ?></textarea>
</div>



<button name="edit" type="submit" class="btn btn-primary btn-block mb-4">
Edit Post
</button>


</form>
</div>
</div>
</div>
</div>
</section>
