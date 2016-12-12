<?php
/**
 * Created by PhpStorm.
 * User: silverhawk
 * Date: 24/11/2016
 * Time: 22:17
 */
?>
<style>
    i, .btn {
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
            <li><a href="#">books</a></li>
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
                <table id="books_table" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Author</th>
                        <th>Category</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($books as $key => $book) {
                        ?>
                        <tr>
                            <td class="id"><?= $book[id] ?></td>
                            <td class="name"><?= $book[name] ?></td>
                            <td class="description"><?= $book[author] ?></td>
                            <td class="created-at"><?= $book[category] ?></td>
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
                        <th>Author</th>
                        <th>Category</th>
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
        $("#books_table").DataTable();
        $(".detail").on('click', function () {
            $.ajax({
                url: "../controllers/BooksController.php?func_name=detail",
                type: "post",
                dataType: "text",
                data: {
                    id: $(this).parent().closest("tr").children('.id').text(),
                },
                success: function (result) {
                    result = JSON.parse(result);
                    //console.log(result);
                    addDetail(result);
                }
            });
        });
        $(".edit").on('click', function () {
            $(window).attr('location', '../controllers/BooksController.php?func_name=update&id=' + $(this).parent().closest("tr").children('.id').text())
        });
        $(".remove").on('click', function () {
            actionRemove($(this).parent().closest("tr").children('.id').text());
        });
    });
    function actionRemove(id) {
        var form = $(document.createElement('form'));
        $(form).attr("action", "../controllers/BooksController.php?func_name=delete");
        $(form).attr("method", "POST");

        var input = $("<input>").attr("type", "hidden").attr("name", "id").val(id);
        $(form).append($(input));
        $(form).submit();
    }
    function redirecToUpdate(value) {
        $(window).attr('location', '../controllers/BooksController.php?func_name=update&id=' + value);
    }
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
            + "<p><label>Author:</label>"
            + "&nbsp;&nbsp;&nbsp;&nbsp;" + result["author"] + "</p>"
            + "</p>"
            + "<p><label>Created at: </label> &nbsp;&nbsp;&nbsp;&nbsp;" + result["created_at"] + "</p>"
            + "<p> <label>Updated at: </label> &nbsp;&nbsp;&nbsp;&nbsp;" + result["updated_at"] + "</p> </div>"
            + "<div class='col-md-6'> "
            + "<p> <label>Category</label> &nbsp;&nbsp;&nbsp;&nbsp;" + result["category"] + "</p>"
            + "<p><label>Amount:</label>"
            + "&nbsp;&nbsp;&nbsp;&nbsp;" + result["amount"] + "</p>"
            + "<p><label>Amount rent:</label>"
            + "&nbsp;&nbsp;&nbsp;&nbsp;" + result["amount_rent"] + "</p>"
            + "<p><label>Cost:</label>"
            + "&nbsp;&nbsp;&nbsp;&nbsp;" + result["cost"] + "</p>"
            + "<p> <label>Description</label> &nbsp;&nbsp;&nbsp;&nbsp;" + result["description"] + "</p>"
            + "</div> </div> </div> "
            + "<div class='box-footer'>"
            + "<button class='btn btn-info' onclick='redirecToUpdate(" + result['id'] + ")'>Edit</button>"
            + "<button class='btn btn-danger' onclick='actionRemove("+result['id']+")'>Remove</button>"
            + "<button class='btn btn-warning' data-widget='remove'>Close</button>"
            + "</div>"
            + "</div>";
        $(".area-detail").prepend(innerHTML);

    }
</script>

