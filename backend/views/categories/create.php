<?php
/**
 * Created by PhpStorm.
 * User: silverhawk
 * Date: 24/11/2016
 * Time: 22:17
 */
?>
<?php include("../views/layout/header.php"); ?>
<?php include("../views/layout/sidebar.php"); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Create
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Categories</a></li>
            <li class="active">Create</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <?php if (isset($errors['success']) && $errors['success'] !== "") {
            echo "<div class=\"callout callout-success\">
          <h4>Success!</h4>

          <p>$errors[success]</p>
        </div>";
        } ?>
        <?php if (isset($errors['error']) && $errors['error'] !== "") {
            echo "<div class=\"callout callout-warning\">
          <h4>Warning!</h4>

          <p>$errors[error]</p>
        </div>";
        } ?>
        <div class=" col-sm-6 col-sm-offset-3">
            <div class="box box-success">
                <div class="box-header with-border">
                <h3 class="box-title">Create new Category</h3>
            </div>
                <div class="box-body">
                    <form class="" method="post"
                          action="../controllers/CategoriesController.php?func_name=create">
                        <div class="form-group has-feedback">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control">
                            <?php
                            if (!empty($errors) && !empty($errors['name'])) {
                                echo "<div class='has-error alert-danger form-control'>$errors[name]</div>";
                            } ?>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" class="form-control" rows="6"></textarea>
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-success">Create</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </section>
    <!-- /.content -->
</div>
<?php include("../views/layout/footer.php"); ?>
