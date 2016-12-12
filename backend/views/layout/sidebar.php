<?php
/**
 * Created by PhpStorm.
 * User: silverhawk
 * Date: 24/11/2016
 * Time: 22:26
 */?>
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.3.8/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?= $_SESSION['hn_username'] ?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> <?= $_SESSION['hn_level'] ?></a>
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Categoties</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="../controllers/CategoriesController.php?func_name=index"><i class="fa fa-circle-o"></i> Analys</a></li>
                    <li><a href="../controllers/CategoriesController.php?func_name=create"><i class="fa fa-circle-o"></i> Add new</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-book"></i> <span>Books</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="../controllers/BooksController.php?func_name=index"><i class="fa fa-circle-o"></i> Analys</a></li>
                    <li><a href="../controllers/BooksController.php?func_name=create"><i class="fa fa-circle-o"></i> Add new</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-book"></i> <span>Users</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="../controllers/UsersController.php?func_name=index"><i class="fa fa-circle-o"></i> Analys</a></li>
                    <li><a href="../controllers/UsersController.php?func_name=create"><i class="fa fa-circle-o"></i> Add new</a></li>
                </ul>
            </li>

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
