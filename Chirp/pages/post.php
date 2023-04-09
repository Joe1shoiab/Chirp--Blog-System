<?php
include_once '../config/database.php';
include_once '../classes/post.php';
session_start();

include('../includes/header.php');
include('../includes/navbar.php');

$postobj = new POST($pdo);

if (isset($_GET['id'])) {
    if ($postobj->readPost($_GET['id'])) {

        $post = $postobj->readPost($_GET['id']);
    }
}

if (isset($_POST['delete_post'])) {
    if ($postobj->delete($_GET['id'])) {
        header('Location: ../index.php');
    }
}

?>


<!-- Page Header-->
<header class="masthead" style="background-image: url('../assets/img/post-bg.jpg')">
    <div class="container position-relative px-4 px-lg-5">

        <?php if($_SESSION['user_id']===$post['user_id']) {?>
        <!-- This won't enable the user to edit or delete if he isn't the author-->


        <form method="post">
            <button class="btn" type="submit" name="delete_post"><i class="fas fa-trash text-white fs-3"></i></button>
        </form>

        <a href=<?= "edit_post.php?id=" . $_GET['id'] ?> class=" btn" type="submit"><i
                class="fas fa-edit text-white fs-3"></i></a>

        <?php }?>


        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="post-heading">
                <h2>
                    <?php
                    if (isset($post['title'])) :
                        echo $post['title'];
                    endif
                    ?>
                </h2>

                <span class="meta">

                    Posted by
                    <a href="#!"> <!--try to make a page displays this author's-->
                        <?php
                        if (isset($post['author_name'])) :
                            echo ' '.$post['author_name'].' ';
                        endif
                        ?>
                    </a>
                    <?php
                    if ($post) :
                        echo substr($post['created_at'], 0, 16);
                    endif
                    ?>
                </span>
            </div>
        </div>
    </div>
    </div>
</header>
<!-- Post Content-->
<article class="mb-4">
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <p>
                    <?php
                    if ($post) :
                        echo $post['content'];
                    endif
                    ?>
                </p>
            </div>
        </div>
    </div>
</article>

<?php
include('../includes/footer.php');
?>