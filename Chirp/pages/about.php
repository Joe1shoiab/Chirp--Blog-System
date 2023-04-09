<?php
session_start();

include('../includes/header.php');
include('../includes/navbar.php');
?>
<nav class="navbar navbar-expand-lg navbar-light" id="mainNav">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="../index.php">Chirp</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto py-4 py-lg-0">
                    <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="home.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="">About</a></li>
                    <?php
                    if (!isset($_SESSION['user_id'])) {
                    ?>
                    <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="login.php">LOGIN</a></li>
                    <?php } else { ?>
                    <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="add_post.php">Add
                            Post</a>
                    </li>
                    <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4"
                            href=""><?= $_SESSION['username'] ?></a></li>
                    <?php } ?>

                </ul>
            </div>
        </div>
    </nav>
    <header class="masthead" style="background-image: url('../assets/img/about-bg.jpg')">
        <div class="container position-relative px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="site-heading">
                        <h1>Chirp</h1>
                        <span class="subheading">Chirp is a unique blogging platform that provides a space for you to share your thoughts and ideas with the world.
                            Chirp allows you to express yourself in short,
                            bite-sized posts - perfect for those who want to share their thoughts quickly and efficiently.
                            Whether you're an aspiring writer, a seasoned blogger, or simply someone who enjoys writing,
                            Chirp is the perfect platform for you to connect with others and showcase your writing skills.
                            So why wait? Sign up for Chirp today and start sharing your thoughts with the world.</span>
                    </div>
                </div>
            </div>
        </div>
    </header>
<?php
include('../includes/footer.php');
?>