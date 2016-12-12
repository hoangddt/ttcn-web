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
            Profile
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Auth</a></li>
            <li class="active">Profile</li>
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
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="box box-default">
                    <div class="box-body">
                        <form method="post" action="../controllers/UsersController.php?func_name=changePassword">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group has-feedback">
                                        <label for="old-password">Old Password</label>
                                        <input type="password" name="old-password" class="form-control"/>
                                        <?php
                                        if (!empty($errors) && !empty($errors['username'])) {
                                            echo "<div class='has-error alert-danger form-control'>$errors[username]</div>";
                                        } ?>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label for="new-password">New Password</label>
                                        <input type="password" name="new-password" class="form-control"/>
                                        <?php
                                        if (!empty($errors) && !empty($errors['username'])) {
                                            echo "<div class='has-error alert-danger form-control'>$errors[username]</div>";
                                        } ?>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label for="confirm-password">Password confirm</label>
                                        <input type="password" name="confirm-password" class="form-control"/>
                                        <?php
                                        if (!empty($errors) && !empty($errors['username'])) {
                                            echo "<div class='has-error alert-danger form-control'>$errors[username]</div>";
                                        } ?>
                                    </div>
                                </div>
                                <!-- /.col -->
                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-default">Change Password</button>
                            </div>
                        </form>
                        <!-- /.row -->
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- /.content -->
</div>
<?php include("../views/layout/footer.php"); ?>

