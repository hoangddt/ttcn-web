<?php
/**
 * Created by PhpStorm.
 * User: silverhawk
 * Date: 24/11/2016
 * Time: 22:17
 */
require_once "../controllers/AuthController.php";
$auth = new AuthController();
$auth->auth();
?>
<?php include("layout/header.php"); ?>
<?php include("layout/sidebar.php"); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Hello
            <small>Blank example to the fixed layout</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Layout</a></li>
            <li class="active">Fixed</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

    </section>
    <!-- /.content -->
</div>
<?php include("layout/footer.php"); ?>
