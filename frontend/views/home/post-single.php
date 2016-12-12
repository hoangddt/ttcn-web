
<?php
include_once '../views/layout/head.php'; ?>
    <body>
<?php include_once '../views/layout/header.php' ?>
<?php include_once '../views/layout/nav.php' ?>
<!-- Page breadcrumb -->
<section id="mu-page-breadcrumb">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="mu-page-breadcrumb-area">
                    <h2><?= $post['name'] ?></h2>
                    <ol class="breadcrumb">
                        <li><a href="#"><?= $post['author'] ?></a></li>
                        <li class="active"><?= $post['category'] ?></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End breadcrumb -->
<!-- content -->
<section id="mu-course-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="mu-course-content-area">
                    <div class="row">
                        <div class="col-md-9">
                            <!-- start course content container -->
                            <div class="mu-course-container mu-blog-single">
                                <div class="row">
                                    <div class="col-md-12">
                                        <article class="mu-blog-single-item">
                                            <figure class="mu-blog-single-img">
                                                <figcaption class="mu-blog-caption">
                                                    <h3><a href="#"><?= $post['name'] ?></a></h3>
                                                </figcaption>
                                            </figure>
                                            <div class="mu-blog-meta">
                                                <a href="#"><?= $post['author'] ?></a>
                                                <a href="#"><?= $post['created_at'] ?></a>
                                            </div>
                                            <div class="mu-blog-description">
                                                <?= $post['details'] ?>
                                            </div>
                                        </article>
                                    </div>
                                </div>
                            </div>
                            <!-- end course content container -->
                            <!-- start blog navigation -->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mu-blog-single-navigation">
                                        <a class="mu-blog-prev" href="../controllers/PostsController.php?func_name=nextPost&id=<?=$post['id']?>"><span class="fa fa-angle-left"></span>Prev</a>
                                        <a class="mu-blog-next" href="../controllers/PostsController.php?func_name=nextPost&id=<?=$post['id']?>">Next<span class="fa fa-angle-right"></span></a>
                                    </div>
                                </div>
                            </div>
                            <!-- end blog navigation -->
                            <!-- start related course item -->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mu-related-item">
                                        <h3>Related News</h3>
                                        <div class="mu-related-item-area">
                                            <div id="mu-related-item-slide">
                                                <?php foreach ($relatedBooks as $key => $relatedBook) { ?>
                                                    <div class="col-md-6">
                                                        <article class="mu-blog-single-item">
                                                            <figure class="mu-blog-single-img">
                                                                <a href="#"><img alt="img" class="img-responsive" style="height: 250px" src="<?=$relatedBook['avatar']?>"></a>
                                                                <figcaption class="mu-blog-caption">
                                                                    <h3><a href="#"><?= $relatedBook['name'] ?></a></h3>
                                                                </figcaption>
                                                            </figure>
                                                            <div class="mu-blog-meta">
                                                                <a href="#"><?= $relatedBook['author'] ?></a>
                                                                <a href="#"><?= $relatedBook['created_at'] ?></a>
                                                            </div>
                                                            <div class="mu-blog-description">
                                                                <p><?= $relatedBook['description'] ?></p>
                                                                <a href="#" class="mu-read-more-btn">Read More</a>
                                                            </div>
                                                        </article>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end start related course item -->
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
                                        <?php }?>
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
<!-- /content -->
<?php include_once '../views/layout/footer.php' ?>
