
<!-- Start nav -->
<section id="mu-menu">
    <nav class="navbar navbar-default" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <!-- FOR MOBILE VIEW COLLAPSED BUTTON -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- LOGO -->
                <!-- TEXT BASED LOGO -->
                <a class="navbar-brand" href="../controllers/HomeController.php?func_name=index"><i class="fa fa-university"></i><span>Hiền Nhân</span></a>
                <!-- IMG BASED LOGO  -->
                <!-- <a class="navbar-brand" href="index.html"><img src="assets/img/logo.png" alt="logo"></a> -->
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul id="top-menu" class="nav navbar-nav navbar-right main-nav">
                    <li class="<?= ($_GET['func_name']=='index')? active: ''?>"><a href="../controllers/HomeController.php?func_name=index">Trang chủ</a></li>
                    <li class="dropdown <?= ($_GET['func_name']=='posts')? active: ''?>">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Thể loại <span class="fa fa-angle-down"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <?php foreach ($categories as $key => $category) { ?>
                            <li><a href="../controllers/PostsController.php?func_name=posts&id=<?= $category['id'] ?>"><?= $category['name'] ?></a></li>
                            <?php } ?>
                        </ul>
                    </li>
                    <li class="dropdown <?= ($_GET['func_name']=='about')? active: ''?>">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Về chúng tôi <span class="fa fa-angle-down"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="course.html">Giới thiệu</a></li>
                            <li><a href="course-detail.html">Liên hệ</a></li>
                            <li><a href="course-detail.html">Đặt sách</a></li>
                        </ul>
                    </li>
                    <li><a href="#" id="mu-search-icon"><i class="fa fa-search"></i></a></li>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </nav>
</section>
<!-- End nav -->
<!-- Start search box -->
<div id="mu-search">
    <div class="mu-search-area">
        <button class="mu-search-close"><span class="fa fa-close"></span></button>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <form class="mu-search-form">
                        <input type="search" placeholder="Type Your Keyword(s) & Hit Enter">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End search box -->