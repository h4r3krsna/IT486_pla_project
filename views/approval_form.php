<?php
$f3 = \Base::instance();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prior Learning Assessment Request Form - Green River College</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <style>
        .form-group {
            margin-top: 20px;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Prior Learning Assessment Request Form</h1>
    <form id="plaform" name="plaform" action="#">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <div class="form-group">
                    <fieldset>
                        <legend>Personal Identification</legend>
                        <label for="student-id">Student ID#:</label>
                        <input type="number" class="form-control" id="student-id" name="student-id" value="<?php echo $f3->get("studentid"); ?>" disabled>
                        <label for="first-name">First Name:</label>
                        <input type="text" class="form-control" id="first-name" name="first-name" value="<?php echo $f3->get("firstname"); ?>" disabled>
                        <label for="last-name">Last Name:</label>
                        <input type="text" class="form-control" id="last-name" name="last-name" value="<?php echo $f3->get("lastname"); ?>" disabled>
                        <label for="student-email">Student Email:</label>
                        <input type="email" class="form-control" id="student-email" name="student-email" value="<?php echo $f3->get("studentemail"); ?>" disabled>
                    </fieldset>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <div class="form-group">
                    <fieldset>
                        <legend>Internship Information</legend>
                        <label for="internship-title">Internship Title:</label>
                        <input type="text" class="form-control" id="internship-title" name="internship-title" value="<?php echo $f3->get("internshiptitle"); ?>" disabled>
                        <label for="company">Company:</label>
                        <input type="text" class="form-control" id="company" name="company" value="<?php echo $f3->get("company"); ?>" disabled>
                        <label for="start-date">Start Date:</label>
                        <input type="date" class="form-control" id="start-date" name="start-date" value="<?php echo $f3->get("startdate"); ?>" disabled>
                        <label for="end-date">End Date:</label>
                        <input type="date" class="form-control" id="end-date" name="end-date" value="<?php echo $f3->get("enddate"); ?>" disabled>
                        <label for="hours-worked">Hours Worked:</label>
                        <input type="number" class="form-control" id="hours-worked" name="hours-worked" value="<?php echo $f3->get("hoursworked"); ?>" disabled>
                    </fieldset>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <div class="form-group">
                    <fieldset>
                        <legend>Supervisor Details</legend>
                        <label for="supervisor-name">Supervisor Name:</label>
                        <input type="text" class="form-control" id="supervisor-name" name="supervisor-name" value="<?php echo $f3->get("supervisorname"); ?>" disabled>
                        <label for="supervisor-title">Supervisor Title:</label>
                        <input type="text" class="form-control" id="supervisor-title" name="supervisor-title" value="<?php echo $f3->get("supervisortitle"); ?>" disabled>
                        <label for="supervisor-email">Supervisor Email:</label>
                        <input type="email" class="form-control" id="supervisor-email" name="supervisor-email" value="<?php echo $f3->get("supervisoremail"); ?>" disabled>
                        <label for="supervisor-phone">Supervisor Phone:</label>
                        <input type="number" class="form-control" id="supervisor-phone" name="supervisor-phone" value="<?php echo $f3->get("supervisorphone"); ?>" disabled>
                    </fieldset>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <div class="form-group">
                    <fieldset>
                        <legend>Description of Duties</legend>
                        <textarea class="form-control" id="duties-description" name="duties-description" rows="11" disabled><?php echo $f3->get("dutiesdescription"); ?></textarea>
                    </fieldset>
                </div>
            </div>
        </div>
    </form>
</div>
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>