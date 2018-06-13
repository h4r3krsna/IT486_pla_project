<?php
require('top.php');
?>

<!-- <p style="text-align: center">Please enter your credentials to view entry # {{ @entryId }}</p> -->

<h1 style="text-align: center;">Please enter your credentials</h1>

<form action="" method="POST">
    <div class="row">
        <div class="form-group col-xs-12 col-md-offset-5 col-md-2">
            <label for="username">username:</label>
            <input type="text" class="form-control" id="username" name="username" placeholder="" autofocus required>
        </div>
        <div class="form-group col-xs-12 col-md-offset-5 col-md-2">
            <label for="password">password:</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="" required>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-xs-12 col-md-offset-5 col-md-2">
            <input type="submit" class="btn btn-primary" value="Submit">
        </div>
    </div>
</form>

<?php
require('bottom.php');
?>
