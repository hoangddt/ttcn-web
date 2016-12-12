<?php
include_once '../views/layout/head.php'; ?>
<body>
<?php include_once '../views/layout/header.php' ?>
<?php include_once '../views/layout/nav.php' ?>
<!-- Start Slider -->
<section id="mu-slider">
    <!-- Start single slider item -->
    <div class="mu-slider-single">
        <div class="mu-slider-img">
            <figure>
                <img src="../bootstrap/img/home-sliders/about-us.jpg" alt="img">
            </figure>
        </div>
        <div class="mu-slider-content">
            <h4>Welcome To Varsity</h4>
            <span></span>
            <h2>We Will Help You To Learn</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolor amet error eius reiciendis eum sint unde
                eveniet deserunt est debitis corporis temporibus recusandae accusamus.</p>
            <a href="#" class="mu-read-more-btn">Read More</a>
        </div>
    </div>
    <!-- Start single slider item -->
    <!-- Start single slider item -->
    <div class="mu-slider-single">
        <div class="mu-slider-img">
            <figure>
                <img src="../bootstrap/img/home-sliders/books.jpg" alt="img">
            </figure>
        </div>
        <div class="mu-slider-content">
            <h4>Premiumu Quality Free Template</h4>
            <span></span>
            <h2>Best Education Template Ever</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolor amet error eius reiciendis eum sint unde
                eveniet deserunt est debitis corporis temporibus recusandae accusamus.</p>
            <a href="#" class="mu-read-more-btn">Read More</a>
        </div>
    </div>
    <!-- Start single slider item -->
    <!-- Start single slider item -->
    <div class="mu-slider-single">
        <div class="mu-slider-img">
            <figure>
                <img src="../bootstrap/img/home-sliders/news.jpg" alt="img">
            </figure>
        </div>
        <div class="mu-slider-content">
            <h4>Exclusivly For Education</h4>
            <span></span>
            <h2>Education For Everyone</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolor amet error eius reiciendis eum sint unde
                eveniet deserunt est debitis corporis temporibus recusandae accusamus.</p>
            <a href="#" class="mu-read-more-btn">Read More</a>
        </div>
    </div>
    <!-- Start single slider item -->
</section>
<!-- End Slider -->
<!-- Start service  -->
<section id="mu-service">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="mu-service-area">
                    <!-- Start single service -->
                    <div class="mu-service-single">
                        <span class="fa fa-book"></span>
                        <h3>Sách</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima officiis, deleniti dolorem
                            exercitationem praesentium, est!</p>
                    </div>
                    <!-- Start single service -->
                    <!-- Start single service -->
                    <div class="mu-service-single">
                        <span class="fa fa-users"></span>
                        <h3>Tin Tức</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima officiis, deleniti dolorem
                            exercitationem praesentium, est!</p>
                    </div>
                    <!-- Start single service -->
                    <!-- Start single service -->
                    <div class="mu-service-single">
                        <span class="fa fa-table"></span>
                        <h3>Mượn sách</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima officiis, deleniti dolorem
                            exercitationem praesentium, est!</p>
                    </div>
                    <!-- Start single service -->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End service  -->
<!-- Start about us -->
<section id="mu-about-us">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="mu-about-us-area">
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="mu-about-us-left">
                                <!-- Start Title -->
                                <div class="mu-title">
                                    <h2>Về chúng tôi</h2>
                                </div>
                                <!-- End Title -->
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rerum pariatur fuga eveniet
                                    soluta aspernatur rem, nam voluptatibus voluptate voluptates sapiente, inventore.
                                    Voluptatem, maiores esse molestiae.</p>
                                <ul>
                                    <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</li>
                                    <li>Saepe a minima quod iste libero rerum dicta!</li>
                                    <li>Voluptas obcaecati, iste porro fugit soluta consequuntur. Veritatis?</li>
                                    <li>Ipsam deserunt numquam ad error rem unde, omnis.</li>
                                    <li>Repellat assumenda adipisci pariatur ipsam eos similique, explicabo.</li>
                                </ul>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perspiciatis quaerat harum
                                    facilis excepturi et? Mollitia!</p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="mu-about-us-right">
                                <a id="mu-abtus-video" href="https://www.youtube.com/embed/HN3pm9qYAUs"
                                   target="mutube-video">
                                    <img src="assets/img/about-us.jpg" alt="img">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End about us -->
<!-- Start latest book section -->
<section id="mu-latest-courses">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="mu-latest-courses-area">
                    <!-- Start Title -->
                    <div class="mu-title">
                        <h2>Sách Mới</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Distinctio ipsa ea maxime mollitia,
                            vitae voluptates, quod at, saepe reprehenderit totam aliquam architecto fugiat sunt
                            animi!</p>
                    </div>
                    <!-- End Title -->
                    <!-- Start latest course content -->
                    <div id="mu-latest-course-slide" class="mu-latest-courses-content">
                        <?php foreach ($lastedBooks as $key => $book) { ?>
                            <div class="col-lg-4 col-md-4 col-xs-12">
                                <div class="mu-latest-course-single">
                                    <figure class="mu-latest-course-img">
                                        <a href="../controllers/PostsController.php?func_name=post&id=<?= $book['id'] ?>"><img
                                                class="img-responsive" style="height: 150px"
                                                src="<?= $book['avatar'] ?>" alt="img"></a>
                                        <figcaption class="mu-latest-course-imgcaption">
                                            <a href="../controllers/PostsController.php?func_name=post&id=<?= $book['id'] ?>"><?= $book['name'] ?></a>
                                        </figcaption>
                                    </figure>
                                    <div class="mu-latest-course-single-content">
                                        <h4>
                                            <a href="../controllers/PostsController.php?func_name=post&id=<?= $book['id'] ?>"><?= $book['author'] ?></a>
                                        </h4>
                                        <p><?= $book['description'] ?></p>
                                        <div class="mu-latest-course-single-contbottom">
                                            <a class="mu-course-details"
                                               href="../controllers/PostsController.php?func_name=post&id=<?= $book['id'] ?>">Details</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <!-- End latest course content -->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End latest book section -->
<!-- Start testimonial -->
<section id="mu-testimonial">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="mu-testimonial-area">
                    <div id="mu-testimonial-slide" class="mu-testimonial-content">
                        <!-- start testimonial single item -->
                        <div class="mu-testimonial-item">
                            <div class="mu-testimonial-quote">
                                <blockquote>
                                    <p>Chúng ta hãy đọc và hãy nhảy múa - hai niềm vui không bao giờ làm hại thế giới này.
                                    </p>
                                </blockquote>
                            </div>
                            <div class="mu-testimonial-info">
                                <span>Voltaire</span>
                            </div>
                        </div>
                        <!-- end testimonial single item -->
                        <!-- start testimonial single item -->
                        <div class="mu-testimonial-item">
                            <div class="mu-testimonial-quote">
                                <blockquote>
                                    <p>
                                        Những gì sách dạy chúng ta cũng giống như lửa. Chúng ta lấy nó từ nhà hàng xóm,
                                        thắp nó trong nhà ta, đem nó truyền cho người khác, và nó trở thành tài sản của
                                        tất cả mọi người.
                                </blockquote>
                            </div>
                            <div class="mu-testimonial-info">
                                <span>Voltaire</span>
                            </div>
                        </div>
                        <!-- end testimonial single item -->
                        <!-- start testimonial single item -->
                        <div class="mu-testimonial-item">
                            <div class="mu-testimonial-quote">
                                <blockquote>
                                    <p>
                                        Tôi đọc lồi cả mắt và vẫn không đọc được đủ tới một nửa... người ta càng đọc
                                        nhiều, người ta càng thấy còn nhiều điều cần phải đọc.
                                    </p>
                                </blockquote>
                            </div>
                            <div class="mu-testimonial-info">
                                <span>Join Adams</span>
                            </div>
                        </div>
                        <!-- end testimonial single item -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End testimonial -->
<?php include_once '../views/layout/footer.php' ?>
