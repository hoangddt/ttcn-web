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
            <li><a href="#">Books</a></li>
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
                <form method="post" action="../controllers/BooksController.php?func_name=create">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group has-feedback">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control">
                                <?php
                                if (!empty($errors) && !empty($errors['name'])) {
                                    echo "<div class='has-error alert-danger form-control'>$errors[name]</div>";
                                } ?>
                            </div>
                            <!-- AUTHOR -->
                            <div class="form-group has-feedback">
                                <label for="author">Author</label>
                                <input type="text" name="author" class="form-control">
                                <?php
                                if (!empty($errors) && !empty($errors['author'])) {
                                    echo "<div class='has-error alert-danger form-control'>$errors[author]</div>";
                                } ?>
                            </div>
                            <!-- AMOUNT -->
                            <div class="form-group has-feedback">
                                <label for="amount">Amount</label>
                                <input type="text" name="amount" class="form-control">
                                <?php
                                if (!empty($errors) && !empty($errors['amount'])) {
                                    echo "<div class='has-error alert-danger form-control'>$errors[amount]</div>";
                                } ?>
                            </div>
                            <!-- COST -->
                            <div class="form-group has-feedback">
                                <label for="cost">Cost</label>
                                <input type="text" name="cost" class="form-control">
                                <?php
                                if (!empty($errors) && !empty($errors['cost'])) {
                                    echo "<div class='has-error alert-danger form-control'>$errors[cost]</div>";
                                } ?>
                            </div>

                        </div>
                        <!-- /.col -->
                        <div class="col-md-6">
                            <!-- CATEGORY -->
                            <div class="form-group">
                                <label for="category">Category</label>
                                <select name="category_id" class="form-control">
                                    <?php foreach ($categories as $key => $category) {?>
                                        <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
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
                    <div class="row">
                        <div class="col-xs-12">
                            <label for="details">Detail</label>
                            <textarea name="details" id="details" rows="20" cols="80" class="">
                            This is my textarea to be replaced with CKEditor.
                        </textarea>
                        </div>
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


