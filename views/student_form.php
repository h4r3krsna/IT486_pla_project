<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Prior Learning Assessment Request Form - Green River College</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <style>

    </style>
</head>
<body>
<div class="container">
    <h1>Prior Learning Assessment Request Form</h1>
    <form id="plaform" name="plaform" action="" onsubmit="return validateForm()" method="POST">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <div class="form-group">
                    <fieldset>
                        <legend>Personal Identification</legend>
                        <label for="student-id">Student ID#:</label>
                        <input type="number" class="form-control" id="student-id" name="student-id" placeholder="XXXXXXXXX" required>
                        <label for="first-name">First Name:</label>
                        <input type="text" class="form-control" id="first-name" name="first-name" placeholder="" required>
                        <label for="last-name">Last Name:</label>
                        <input type="text" class="form-control" id="last-name" name="last-name" placeholder="" required>
                        <label for="student-email">Student Email:</label>
                        <input type="email" class="form-control" id="student-email" name="student-email" placeholder="" required>
                    </fieldset>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <div class="form-group">
                    <fieldset>
                        <legend>Internship Information</legend>
                        <label for="internship-title">Internship Title:</label>
                        <input type="text" class="form-control" id="internship-title" name="internship-title" placeholder="" required>
                        <label for="company">Company:</label>
                        <input type="text" class="form-control" id="company" name="company" placeholder="" required>
                        <label for="start-date">Start Date:</label>
                        <input type="date" class="form-control" id="start-date" name="start-date" placeholder="" required>
                        <label for="end-date">End Date:</label>
                        <input type="date" class="form-control" id="end-date" name="end-date" placeholder="" required>
                        <label for="hours-worked">Hours Worked:</label>
                        <input type="number" class="form-control" id="hours-worked" name="hours-worked" placeholder="" required>
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
                        <input type="text" class="form-control" id="supervisor-name" name="supervisor-name" placeholder="" required>
                        <label for="supervisor-title">Supervisor Title:</label>
                        <input type="text" class="form-control" id="supervisor-title" name="supervisor-title" placeholder="" required>
                        <label for="supervisor-email">Supervisor Email:</label>
                        <input type="email" class="form-control" id="supervisor-email" name="supervisor-email" placeholder="" required>
                        <label for="supervisor-phone">Supervisor Phone:</label>
                        <input type="number" class="form-control" id="supervisor-phone" name="supervisor-phone" placeholder="XXXXXXXXXX" required>
                    </fieldset>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <div class="form-group">
                    <fieldset>
                        <legend>Description of Duties</legend>
                        <!--<label for="duties-description">Description of Duties:</label>-->
                        <textarea class="form-control" id="duties-description" name="duties-description" rows="11" required></textarea>
                    </fieldset>
                </div>
            </div>
        </div>
        <input type="submit" class="btn btn-primary pull-right" value="Submit">
    </form>
</div>
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script>
    function isValidStudentID(input) {
        return input.length == 9 && /\d{9}/.test(input);
    }

    function isValidEmail(input) {
        var re = /^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
        return re.test(input);
    }

    function isValidDate(input) {
        return input.length == 10 && /\d{4}-[01]\d-[0-3]\d/.test(input);
    }

    function isValidPhone(input) {
        return input.length == 10 && /\d{10}/.test(input);
    }

    function validateForm() {
        var isValidForm = true;
        var plaform = $('#plaform');

        plaform.find('input[type="text"], input[type="number"], input[type="date"], input[type="email"], textarea').each(function() {
            isValidForm = isValidForm && ($(this).val().length > 0);
        });

        isValidForm = isValidForm
                      && isValidStudentID($('#student-id').val())
                      && isValidEmail($('#student-email').val())
                      && isValidDate($('#start-date').val())
                      && isValidDate($('#end-date').val())
                      && $.isNumeric($('#hours-worked').val())
                      && isValidEmail($('#supervisor-email').val())
                      && isValidPhone($('#supervisor-phone').val());

        return isValidForm;
    }
</script>
</body>
</html>