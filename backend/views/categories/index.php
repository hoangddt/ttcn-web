<?php
/**
 * Created by PhpStorm.
 * User: silverhawk
 * Date: 24/11/2016
 * Time: 22:17
 */
?>
<style>
    i {
        margin: 0px 5px 0px 5px;
    }
</style>
<?php include("../views/layout/header.php"); ?>
<?php include("../views/layout/sidebar.php"); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Analys
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Categories</a></li>
            <li class="active">Analys</li>
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
            echo "<div class=\"callout callout-danger\">
          <h4>Error!</h4>

          <p>$errors[error]</p>
        </div>";
        } ?>
        <!-- /.box -->
        <!-- EDIT -->
        <div class="area-edit">
        </div>
        <!-- EDIT -->
        <!-- DETAILS -->
        <div class="area-detail">

        </div>
        <!-- /DETAILS -->
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Data Table With Full Features</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="categories_table" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Created at</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($categories as $key => $category) {
                        ?>
                        <tr>
                            <td class="id"><?= $category[id] ?></td>
                            <td class="name"><?= $category[name] ?></td>
                            <td class="description"><?= $category[description] ?></td>
                            <td class="created-at"><?= $category[created_at] ?></td>
                            <td>
                                <i class="detail fa fa-eye text-info" aria-hidden="true"></i>
                                <i class="edit fa fa-pencil-square-o text-default" aria-hidden="true"></i>
                                <i class="remove fa fa-times text-danger" aria-hidden="true"></i>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Created at</th>
                        <th>Action</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
</div>

<?php include("../views/layout/footer.php"); ?>
<script>
    $(function () {
        $("#categories_table").DataTable();
        $(".detail").on('click', function () {
            console.log($(this).parent().closest("tr").children('.id').text());
            $.ajax({
                url: "../controllers/CategoriesController.php?func_name=detail",
                type: "post",
                dataType: "text",
                data: {
                    id: $(this).parent().closest("tr").children('.id').text(),
                },
                success: function (result) {
                    //console.log(result);
                    result = JSON.parse(result);
                    //console.log(result);
                    addDetail(result);
                }
            });
        });
        $(".edit").on('click', function () {
            $.ajax({
                url: "../controllers/CategoriesController.php?func_name=detail",
                type: "post",
                dataType: "text",
                data: {
                    id: $(this).parent().closest("tr").children('.id').text(),
                },
                success: function (result) {
                    //console.log(result);
                    result = JSON.parse(result);
                    console.log(result);
                    addEdit(result);
                }
            });
        });
        $(".remove").on('click', function () {
            var form = $(document.createElement('form'));
            $(form).attr("action", "../controllers/CategoriesController.php?func_name=delete");
            $(form).attr("method", "POST");

            var input = $("<input>").attr("type", "hidden").attr("name", "id").val($(this).parent().closest("tr").children('.id').text());
            $(form).append($(input));
            $(form).submit();
        });
    })
    ;
    function addDetail(result) {
        var innerHTML = "<div class='box box-default'>"
            + "<div class='box-header with-border'>"
            + "<h3 class='box-title'>" + result["name"] + "</h3>"
            + "<div class='box-tools pull-right'>"
            + "<button type='button' class='btn btn-box-tool' data" + "-" + "widget='collapse'><i class='fa fa-minus'></i> </button>"
            + "<button type='button' class='btn btn-box-tool' data" + "-" + "widget='remove'><i class='fa fa-remove'></i> </button>"
            + "</div> </div> <div class='box-body'> <div class='row'> <div class='col-md-6'>"
            + "<p><label>ID:</label>"
            + "&nbsp;&nbsp;&nbsp;&nbsp;" + result["id"] + "</p>"
            + "<p><label>Name:</label>"
            + "&nbsp;&nbsp;&nbsp;&nbsp;" + result["name"]
            + "</p>"
            + "<p><label>Created at: </label> &nbsp;&nbsp;&nbsp;&nbsp;" + result["created_at"] + "</p>"
            + "<p> <label>Updated at: </label> &nbsp;&nbsp;&nbsp;&nbsp;" + result["updated_at"] + "</p> </div>"
            + "<div class='col-md-6'> <p> <label>Description</label> &nbsp;&nbsp;&nbsp;&nbsp;" + result["description"] + "</p>"
            + "</div> </div> </div> </div>";
        $(".area-detail").prepend(innerHTML);

    }
    function addEdit(result) {
        var innerHTML = "<div class='box box-default' id='edit-" + result['id'] + "'>"
            + "<div class='box-header with-border'>"
            + "<h3 class='box-title'>" + result[name] + "</h3>"
            + "<div class='box-tools pull-right'>"
            + "<button type='button' class='btn btn-box-tool' data-widget='collapse'><iclass='fa fa-minus'></i></button>"
            + "<button type='button' class='btn btn-box-tool' data-widget='remove'><i class='fa fa-remove'></i> </button>"
            + "</div> </div> <form method='post' action='../controllers/CategoriesController.php?func_name=update'>"
            + "<div class='box-body'> <div class='row'> <div class='col-md-6'> <div class='form-group'>"
            + "<label for='id'>ID</label>"
            + "<input type='text' class='form-control' value='" + result['id'] + "' disabled>"
            + "<input type='hidden' name='id' value='" + result['id'] + "'>"
            + "</div> <div class='form-group'> <label for='name'>Name</label>"
            + "<input type='text' class='form-control' name='name' value='" + result['name'] + "'>"
            + "</div> </div> <div class='col-md-6'> <div class='form-group'> <label for='description'>Description</label>"
            + "<textarea type='text' class='form-control' name='description' rows='4'>" + result['description'] + "</textarea>"
            + "</div> </div> </div> </div> <div class='box-footer'>"
            + "<button type='submit' class='btn btn-default'>Edit</button>"
            + "<button class='btn btn-danger' data-widget='remove'>Close</button>"
            + "</div> </form> </div>";
        if ($("#edit-" + result['id']).length) {
            $("#edit-" + result['id']).remove();
        }
        $('.area-edit').prepend(innerHTML);
    }
</script>

