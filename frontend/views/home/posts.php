<?php include_once '../views/layout/head.php'; ?>
    <body>
<?php include_once '../views/layout/header.php' ?>
<?php include_once '../views/layout/nav.php' ?>
    <!-- Page breadcrumb -->
    <section id="mu-page-breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="mu-page-breadcrumb-area">
                        <h2><?= $posts[0]['category'] ?></h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End breadcrumb -->
    <!-- posts -->
    <section id="mu-course-content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="mu-course-content-area">
                        <div class="row">
                            <div class="col-md-9">
                                <!-- start course content container -->
                                <div class="mu-course-container mu-blog-archive">
                                    <div class="row">
                                        <?php foreach ($posts as $key => $post) { ?>
                                            <div class="col-md-6 col-sm-6" style="padding: 0 40px 0 40px">
                                                <article class="mu-blog-single-item">
                                                    <figure class="mu-blog-single-img">
                                                        <a href="../controllers/PostsController.php?func_name=post&id=<?= $post['id'] ?>"><img
                                                                src="<?= $post['avatar'] ?>" alt="img"
                                                                class="img-responsive" style="height: 200px"></a>
                                                        <figcaption class="mu-blog-caption">
                                                            <h3><a href="#"><?= $post['name'] ?></a></h3>
                                                        </figcaption>
                                                    </figure>
                                                    <div class="mu-blog-meta">
                                                        <a href="../controllers/PostsController.php?func_name=post&id=<?= $post['id'] ?>"><?= $post['author'] ?></a>
                                                        <a href="../controllers/PostsController.php?func_name=post&id=<?= $post['id'] ?>"><?= $post['created_at'] ?></a>
                                                    </div>
                                                    <div class="mu-blog-description">
                                                        <p>
                                                            <?= $post['description'] ?>
                                                        </p>
                                                        <a class="mu-read-more-btn"
                                                           href="../controllers/PostsController.php?func_name=post&id=<?= $post['id'] ?>">Read
                                                            More</a>
                                                    </div>
                                                </article>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <!-- end course content container -->
                                <!-- start course pagination -->
                                <div class="mu-pagination">
                                    <nav>
                                        <ul class="pagination">
                                            <li>
                                                <a href="#" aria-label="Previous">
                                                    <span class="fa fa-angle-left"></span> Prev
                                                </a>
                                            </li>
                                            <?php for ($key = 1; $key <= $paginations['amount']; $key++) { ?>
                                                <li class="<?= ($paginations['offset'] == $key) ? active : '' ?>"><a
                                                        href="../controllers/PostsController.php?func_name=posts&id=<?= $_GET[id] ?>&page=<?= $key ?>"><?= $key ?></a>
                                                </li>
                                            <?php } ?>
                                            <li>
                                                <a href="#" aria-label="Next">
                                                    Next <span class="fa fa-angle-right"></span>
                                                </a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                                <!-- end course pagination -->
                            </div>
                            <div class="col-md-3">
                                <!-- start sidebar -->
                                <aside class="mu-sidebar">
                                    <!-- start single sidebar -->
                                    <div class="mu-single-sidebar">
                                        <h3>Categories</h3>
                                        <ul class="mu-sidebar-catg">
                                            <?php foreach ($categories as $key => $category) { ?>
                                                <li><a href="../controllers/PostsController.php?func_name=posts&id=<?= $category['id'] ?>"><?= $category['name'] ?></a></li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                    <!-- end single sidebar -->
                                </aside>
                                <!-- / end sidebar -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /posts -->

<?php include_once '../views/layout/footer.php' ?>