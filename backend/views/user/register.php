<?php
/**
 * Created by PhpStorm.
 * User: silverhawk
 * Date: 24/11/2016
 * Time: 00:59
 */
$errors = $_SESSION['errors'];
var_dump($errors);
unset($_SESSION['errors']);
?>
<!Doctype html>
<html>
<head>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" type="text/css" rel="stylesheet">
</head>
<body>
<div class="container">
    <form class="col-sm-4 col-sm-offset-4" method="post" action="../../controllers/AuthController.php?func_name=register">
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" value="<?= $errors['email-value'] ?>">
            <?php
            if (!empty($errors) && !empty($errors['email'])) {
                echo "<div class='has-error alert-danger form-control'>$errors[email]</div>";
            } ?>
        </div>
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" class="form-control" value="<?= $errors['username-value'] ?>" >
            <?php
            if (!empty($errors) && !empty($errors['username'])) {
                echo "<div class='has-error alert-danger form-control'>$errors[username]</div>";
            } ?>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control" value="<?= $errors['password-value'] ?>">
            <?php
            if (!empty($errors) && !empty($errors['password'])) {
                echo "<div class='has-error alert-danger form-control'>$errors[password]</div>";
            } ?>
        </div>
        <div class="form-group">
            <label for="password-confirm">Confirm Password</label>
            <input type="password" name="password-confirm" class="form-control" value="<?= $errors['password-confirm-value'] ?>">
            <?php
            if (!empty($errors) && !empty($errors['password-confirm'])) {
                echo "<div class='has-error alert-danger form-control'>".$errors['password-confirm']."</div>";
            } ?>
        </div>
        <div class="form-group">
            <input type="checkbox" value="1" name="remember"/>Remember me
        </div>
        <div class="form-group">
            <input type="submit" value="Register" class="btn btn-primary">
            <input type="reset" value="Reset" class="btn btn-default">
        </div>
    </form>
</div>
</body>
</html>

