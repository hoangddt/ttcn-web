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
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Create
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Users</a></li>
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
        <div class="box box-default">
            <div class="box-body">
                <form method="post" action="../controllers/UsersController.php?func_name=create">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group has-feedback">
                                <label for="username">Username</label>
                                <input type="text" name="username" class="form-control">
                                <?php
                                if (!empty($errors) && !empty($errors['username'])) {
                                    echo "<div class='has-error alert-danger form-control'>$errors[username]</div>";
                                } ?>
                            </div>
                            <!-- AUTHOR -->
                            <div class="form-group has-feedback">
                                <label for="author">Email</label>
                                <input type="email" name="email" class="form-control">
                                <?php
                                if (!empty($errors) && !empty($errors['email'])) {
                                    echo "<div class='has-error alert-danger form-control'>$errors[email]</div>";
                                } ?>
                            </div>
                            <!-- AMOUNT -->
                            <div class="form-group has-feedback">
                                <label for="phone">Phone</label>
                                <input type="text" name="phone" class="form-control">
                                <?php
                                if (!empty($errors) && !empty($errors['phone'])) {
                                    echo "<div class='has-error alert-danger form-control'>$errors[phone]</div>";
                                } ?>
                            </div>
                            <!-- COST -->
                            <div class="form-group has-feedback">
                                <label for="dob">Date of birth</label>
                                <input type="datetime" name="dob" id="dob" class="form-control">
                                <?php
                                if (!empty($errors) && !empty($errors['dob'])) {
                                    echo "<div class='has-error alert-danger form-control'>$errors[dob]</div>";
                                } ?>
                            </div>

                        </div>
                        <!-- /.col -->
                        <div class="col-md-6">
                            <!-- CATEGORY -->
                            <div class="form-group">
                                <label for="level">Level</label>
                                <select name="level" class="form-control">
                                    <?php foreach ($levels as $key => $level) {?>
                                        <option <?= ($level['id']==0)? selected : ''?> value="<?= $level['id'] ?>"><?= $level['name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <!-- DESCIPTION -->
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" class="form-control" rows="6"></textarea>
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-success">Create</button>
                        <button type="reset" class="btn btn-default">Reset</button>
                    </div>
                </form>
                <!-- /.row -->
            </div>
        </div>

    </section>
    <!-- /.content -->
</div>
<?php include("../views/layout/footer.php"); ?>
<script src="//cdn.ckeditor.com/4.6.0/full/ckeditor.js"></script>
<script type="text/javascript">
    //<![CDATA[

    // This call can be placed at any point after the
    // <textarea>, or inside a <head><script> in a
    // window.onload event handler.

    // Replace the <textarea id="editor"> with an CKEditor
    // instance, using default configurations.

    //]]>
    CKEDITOR.replace( 'details',
        {
            filebrowserBrowseUrl :'../../asset/plugin/ckeditor/filemanager/browser/default/browser.html?Connector=http://localhost/bootcamp/basic/hiennhan/asset/plugin/ckeditor/filemanager/connectors/php/connector.php',
            filebrowserImageBrowseUrl : '../../asset/plugin/ckeditor/filemanager/browser/default/browser.html?Type=Image&Connector=http://localhost/bootcamp/basic/hiennhan/asset/plugin/ckeditor/filemanager/connectors/php/connector.php',
            filebrowserFlashBrowseUrl :'../../asset/plugin/ckeditor/filemanager/browser/default/browser.html?Type=Flash&Connector=http://localhost/bootcamp/basic/hiennhan/asset/plugin/ckeditor/filemanager/connectors/php/connector.php',
            filebrowserUploadUrl  :'../../asset/plugin/ckeditor/filemanager/connectors/php/upload.php?Type=File',
            filebrowserImageUploadUrl : '../../asset/plugin/ckeditor/filemanager/connectors/php/upload.php?Type=Image',
            filebrowserFlashUploadUrl : '../../asset/plugin/ckeditor/filemanager/connectors/php/upload.php?Type=Flash'
        });
</script>
<script>
    $( function() {
        $( "#dob" ).datepicker();
    } );
</script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


