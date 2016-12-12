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
            <li><a href="#">Users</a></li>
            <li class="active"Analys</li>
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
                        <th>Email</th>
                        <th>Created at</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($users as $key => $user) {
                        ?>
                        <tr>
                            <td class="id"><?= $user[id] ?></td>
                            <td class="username"><?= $user[username] ?></td>
                            <td class="email"><?= $user[email] ?></td>
                            <td class="created-at"><?= $user[created_at] ?></td>
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
                        <th>Email</th>
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
        $("#books_table").DataTable();
        $(".detail").on('click', function () {
            $.ajax({
                url: "../controllers/UsersController.php?func_name=detail",
                type: "post",
                dataType: "text",
                data: {
                    id: $(this).parent().closest("tr").children('.id').text(),
                },
                success: function (result) {
                    //result = JSON.stringify(result);
                    //console.log(result);
                    result = JSON.parse(result);
                    //console.log(result["id"]);
                    //console.log(result);
                    addDetail(result);
                }
            });
        });
        $(".edit").on('click', function () {
            $.ajax({
                url: "../controllers/UsersController.php?func_name=detail",
                type: "post",
                dataType: "text",
                data: {
                    id: $(this).parent().closest("tr").children('.id').text(),
                },
                success: function (result) {
                    //console.log(result);
                    result = JSON.parse(result);
                    //console.log(result);
                    addEdit(result);
                }
            });
        });
        $(".remove").on('click', function () {
            actionRemove($(this).parent().closest("tr").children('.id').text());
        });
    });
    function actionRemove(id) {
        var form = $(document.createElement('form'));
        $(form).attr("action", "../controllers/UsersController.php?func_name=delete");
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
            + "<h3 class='box-title'>" + result["username"] + "</h3>"
            + "<div class='box-tools pull-right'>"
            + "<button type='button' class='btn btn-box-tool' data" + "-" + "widget='collapse'><i class='fa fa-minus'></i> </button>"
            + "<button type='button' class='btn btn-box-tool' data" + "-" + "widget='remove'><i class='fa fa-remove'></i> </button>"
            + "</div> </div> <div class='box-body'> <div class='row'> <div class='col-md-6'>"
            + "<p><label>ID:</label>"
            + "&nbsp;&nbsp;&nbsp;&nbsp;" + result["id"] + "</p>"
            + "<p><label>Username:</label>"
            + "&nbsp;&nbsp;&nbsp;&nbsp;" + result["username"]
            + "<p><label>Email:</label>"
            + "&nbsp;&nbsp;&nbsp;&nbsp;" + result["email"] + "</p>"
            + "</p>"
            + "<p><label>Created at: </label> &nbsp;&nbsp;&nbsp;&nbsp;" + result["created_at"] + "</p>"
            + "<p> <label>Updated at: </label> &nbsp;&nbsp;&nbsp;&nbsp;" + result["updated_at"] + "</p> </div>"
            + "<div class='col-md-6'> "
            + "<p> <label>DOB</label> &nbsp;&nbsp;&nbsp;&nbsp;" + result["dob"] + "</p>"
            + "<p><label>Phone:</label>"
            + "&nbsp;&nbsp;&nbsp;&nbsp;" + result["phone"] + "</p>"
            + "<p><label>Address:</label>"
            + "&nbsp;&nbsp;&nbsp;&nbsp;" + result["address"] + "</p>"
            + "<p><label>Cost:</label>"
            + "&nbsp;&nbsp;&nbsp;&nbsp;" + result["level"] + "</p>"
            + "<p> <label>Description</label> &nbsp;&nbsp;&nbsp;&nbsp;" + result["description"] + "</p>"
            + "</div> </div> </div> "
            + "<div class='box-footer'>"
            + "<button class='btn btn-danger' onclick='actionRemove("+result['id']+")'>Remove</button>"
            + "<button class='btn btn-warning' data-widget='remove'>Close</button>"
            + "</div>"
            + "</div>";
        $(".area-detail").prepend(innerHTML);
    }
    function addEdit(result) {
        var innerHTML = "<div class='box box-default' id='edit-" + result['id'] + "'>"
            + "<div class='box-header with-border'>"
            + "<h3 class='box-title'>" + result['username'] + "</h3>"
            + "<div class='box-tools pull-right'>"
            + "<button type='button' class='btn btn-box-tool' data-widget='collapse'><iclass='fa fa-minus'></i></button>"
            + "<button type='button' class='btn btn-box-tool' data-widget='remove'><i class='fa fa-remove'></i> </button>"
            + "</div> </div> <form method='post' action='../controllers/UsersController.php?func_name=update'>"
            + "<div class='box-body'> <div class='row'> <div class='col-md-6'>"
            +" <div class='form-group'><label for='id'>ID</label>"
            + "<input type='text' class='form-control' value='" + result['id'] + "' disabled>"
            + "<input type='hidden' name='id' value='" + result['id'] + "'></div>"
            +" <div class='form-group'><label for='username'>Username</label>"
            + "<input type='text' class='form-control' value='" + result['username'] + "' disabled>"
            + "<input type='hidden' name='username' value='" + result['username'] + "'></div>"
            +" <div class='form-group'> <label for='name'>Email</label>"
            + "<input type='text' class='form-control' name='email' value='" + result['email'] + "'></div> "
            +" <div class='form-group'> <label for='phone'>Phone</label>"
            + "<input type='text' class='form-control' name='phone' value='" + result['phone'] + "'></div> "
            +"</div> <div class='col-md-6'>"
            +" <div class='form-group'> <label for='dob'>Date of birth</label>"
            + "<input type='text' class='form-control' name='dob' value='" + result['dob'] + "'></div> "
            +" <div class='form-group'> <label for='address'>Address</label>"
            + "<input type='text' class='form-control' name='address' value='" + result['address'] + "'></div> "
            +" <div class='form-group'> <label for='description'>Description</label>"
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

