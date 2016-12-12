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
        <div class="box box-default">
            <div class="box-body">
                <form method="post" action="../controllers/UsersController.php?func_name=profile">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group has-feedback">
                                <label for="name">Username</label>
                                <input type="text" name="username" class="form-control" value="<?=$user[username] ?>" disabled>
                                <?php
                                if (!empty($errors) && !empty($errors['username'])) {
                                    echo "<div class='has-error alert-danger form-control'>$errors[username]</div>";
                                } ?>
                            </div>
                            <!-- Email -->
                            <div class="form-group has-feedback">
                                <label for="author">Email</label>
                                <input type="text" name="email" class="form-control" value="<?=$user[email] ?>">
                                <?php
                                if (!empty($errors) && !empty($errors['email'])) {
                                    echo "<div class='has-error alert-danger form-control'>$errors[email]</div>";
                                } ?>
                            </div>
                            <!-- Phone -->
                            <div class="form-group has-feedback">
                                <label for="phone">Phone</label>
                                <input type="text" name="phone" class="form-control" value=" <?=$user[phone] ?>">
                            </div>
                            <!-- DOB -->
                            <div class="form-group has-feedback">
                                <label for="cost">Date of birth</label>
                                <input type="text" name="dob" class="form-control" value="<?=$user[dob] ?>">
                            </div>

                        </div>
                        <!-- /.col -->
                        <div class="col-md-6">
                            <!-- ADDRESS -->
                            <div class="form-group has-feedback">
                                <label for="cost">Address</label>
                                <input type="text" name="address" class="form-control" value="<?=$user[address] ?>">
                            </div>
                            <!-- LEVEL -->
                            <div class="form-group has-feedback">
                                <label for="level">Level</label>
                                <input type="text" name="dob" class="form-control" disabled value="<?=$user[level] ?>">
                            </div>
                            <!-- DESCIPTION -->
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" class="form-control" rows="6"><?=$user[description] ?></textarea>
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-success">Edit</button>
                        <button type="button" class="btn btn-default">Change Password</button>
                    </div>
                </form>
                <!-- /.row -->
            </div>
        </div>

    </section>
    <!-- /.content -->
</div>
<?php include("../views/layout/footer.php"); ?>
