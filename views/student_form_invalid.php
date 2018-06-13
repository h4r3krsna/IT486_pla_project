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
        .reflection {
            margin-top: 25px;
        }
        body {
            padding-bottom: 25px;
        }
        .errorField {
            border: 1px solid orangered;
        }
        .validationError {
            color: orangered;
            font-style: italic;
        }
    </style>
</head>
<body>
<div class="container">
    <!--<p><?php print_r($_POST); ln(); ?></p>-->
    <h1>Prior Learning Assessment Request Form</h1>
    <form id="plaform" name="plaform" onsubmit="return validateForm()" method="POST">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <div class="form-group">
                    <fieldset>
                        <legend>Personal Identification</legend>
                        <label for="student-id">Student ID#:<span class="validationError"><?php if(!$_POST['ok-student-id']) echo "* (must be 9 digits)"; ?></span></label>
                        <input type="number" class="form-control <?php if(!$_POST['ok-student-id']) echo "errorField"; ?>" id="student-id" name="student-id" placeholder="XXXXXXXXX" required <?php if($_POST['ok-student-id']) echo "value=\"" . $_POST['student-id'] . "\""; ?>>
                        <label for="first-name">First Name:<span class="validationError"><?php if(!$_POST['ok-first-name']) echo "*"; ?></span></label>
                        <input type="text" class="form-control <?php if(!$_POST['ok-first-name']) echo "errorField"; ?>" id="first-name" name="first-name" placeholder="" required value="<?php if($_POST['ok-first-name']) echo $_POST['first-name']; ?>">
                        <label for="last-name">Last Name:<span class="validationError"><?php if(!$_POST['ok-last-name']) echo "*"; ?></span></label>
                        <input type="text" class="form-control <?php if(!$_POST['ok-last-name']) echo "errorField"; ?>" id="last-name" name="last-name" placeholder="" required value="<?php if($_POST['ok-last-name']) echo $_POST['last-name']; ?>">
                        <label for="student-email">Student Email:<span class="validationError"><?php if(!$_POST['ok-student-email']) echo "* (must be valid email)"; ?></span></label>
                        <input type="email" class="form-control <?php if(!$_POST['ok-student-email']) echo "errorField"; ?>" id="student-email" name="student-email" placeholder="" required value="<?php if($_POST['ok-student-email']) echo $_POST['student-email']; ?>">
                        <label for="student-phone">Student Phone:<span class="validationError"><?php if (!$_POST['ok-student-phone']) echo "* (must be 10 digits)"; ?></span></label>
                        <input type="text" class="form-control <?php if (!$_POST['ok-student-phone']) echo "errorField"; ?>" id="student-phone" name="student-phone" placeholder="XXXXXXXXXX" required value="<?php if($_POST['ok-student-phone']) echo $_POST['student-phone']; ?>">
                    </fieldset>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <div class="form-group">
                    <fieldset>
                        <legend>Internship Information</legend>
                        <label for="internship-title">Internship Title:<span class="validationError"><?php if(!$_POST['ok-internship-title']) echo "*"; ?></span></label>
                        <input type="text" class="form-control <?php if(!$_POST['ok-internship-title']) echo "errorField"; ?>" id="internship-title" name="internship-title" placeholder="" required value="<?php if($_POST['ok-internship-title']) echo $_POST['internship-title']; ?>">
                        <label for="company">Company:<span class="validationError"><?php if(!$_POST['ok-company']) echo "*"; ?></span></label>
                        <input type="text" class="form-control <?php if(!$_POST['ok-company']) echo "errorField"; ?>" id="company" name="company" placeholder="" required value="<?php if($_POST['ok-company']) echo $_POST['company']; ?>">
                        <label for="start-date">Start Date:<span class="validationError"><?php if(!$_POST['ok-start-date']) echo "*"; if(!$_POST['ok-dates']) echo " (must be on/before End Date)"; ?></span></label>
                        <input type="date" class="form-control <?php if(!($_POST['ok-start-date'] && $_POST['ok-dates'])) echo "errorField"; ?>" id="start-date" name="start-date" required value="<?php if($_POST['ok-start-date'] && $_POST['ok-dates']) echo $_POST['start-date']; ?>">
                        <label for="end-date">End Date:<span class="validationError"><?php if(!$_POST['ok-end-date']) echo "*"; if(!$_POST['ok-dates']) echo " (must be on/after Start Date)"; ?></span></label>
                        <input type="date" class="form-control <?php if(!($_POST['ok-end-date'] && $_POST['ok-dates'])) echo "errorField"; ?>" id="end-date" name="end-date" required value="<?php if($_POST['ok-end-date'] && $_POST['ok-dates']) echo $_POST['end-date']; ?>">
                        <label for="hours-worked">Total Hours Worked:<span class="validationError"><?php if(!$_POST['ok-hours-worked']) echo "* (must be a number)"; ?></span></label>
                        <input type="number" class="form-control <?php if(!$_POST['ok-hours-worked']) echo "errorField"; ?>" id="hours-worked" name="hours-worked" placeholder="" required value="<?php if($_POST['ok-hours-worked']) echo $_POST['hours-worked']; ?>">
                    </fieldset>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <div class="form-group">
                    <fieldset>
                        <legend>Supervisor Details</legend>
                        <label for="supervisor-name">Supervisor Name:<span class="validationError"><?php if(!$_POST['ok-supervisor-name']) echo "*"; ?></span></label>
                        <input type="text" class="form-control <?php if(!$_POST['ok-supervisor-name']) echo "errorField"; ?>" id="supervisor-name" name="supervisor-name" placeholder="" required value="<?php if($_POST['ok-supervisor-name']) echo $_POST['supervisor-name']; ?>">
                        <label for="supervisor-title">Supervisor Title:<span class="validationError"><?php if(!$_POST['ok-supervisor-title']) echo "*"; ?></span></label>
                        <input type="text" class="form-control <?php if(!$_POST['ok-supervisor-title']) echo "errorField"; ?>" id="supervisor-title" name="supervisor-title" placeholder="" required value="<?php if($_POST['ok-supervisor-title']) echo $_POST['supervisor-title']; ?>">
                        <label for="supervisor-email">Supervisor Email:<span class="validationError"><?php if(!$_POST['ok-supervisor-email']) echo "* (must be valid email)"; ?></span></label>
                        <input type="email" class="form-control <?php if(!$_POST['ok-supervisor-email']) echo "errorField"; ?>" id="supervisor-email" name="supervisor-email" placeholder="" required value="<?php if($_POST['ok-supervisor-email']) echo $_POST['supervisor-email']; ?>">
                        <label for="supervisor-phone">Supervisor Phone:<span class="validationError"><?php if(!$_POST['ok-supervisor-phone']) echo "* (must be 10 digits)"; ?></span></label>
                        <input type="number" class="form-control <?php if(!$_POST['ok-supervisor-phone']) echo "errorField"; ?>" id="supervisor-phone" name="supervisor-phone" placeholder="XXXXXXXXXX" required value="<?php if($_POST['ok-supervisor-phone']) echo $_POST['supervisor-phone']; ?>">
                    </fieldset>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <div class="form-group">
                    <fieldset>
                        <legend>Description of Duties</legend>
                        <span class="validationError"><?php if(!$_POST['ok-duties-description']) echo "*"; ?></span>
                        <textarea class="form-control <?php if(!$_POST['ok-duties-description']) echo "errorField"; ?>" id="duties-description" name="duties-description" rows="11" required> <?php if($_POST['ok-duties-description']) echo $_POST['duties-description']; ?> </textarea>
                    </fieldset>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="form-group">
                    <fieldset>
                        <legend>Additional Questions</legend>
                        <label for="reflection0">What elements and experiences from your coursework best helped you prepare for your internship experience? Your answer may include technical and non-technical elements. <span class="validationError"><?php if(!$_POST['ok-reflection0']) echo "*"; ?></span></label>
                        <textarea class="form-control <?php if(!$_POST['ok-reflection0']) echo "errorField"; ?>" id="reflection0" name="reflection0" rows="11" required> <?php if($_POST['ok-reflection0']) echo $_POST['reflection0']; ?> </textarea>
                        <label for="reflection1" class="reflection">What did you learn in your internship experience, either directly at work or independently to support your work? Your answer may include technical and non-technical items. <span class="validationError"><?php if(!$_POST['ok-reflection1']) echo "*"; ?></span></label>
                        <textarea class="form-control <?php if(!$_POST['ok-reflection1']) echo "errorField"; ?>" id="reflection1" name="reflection1" rows="11" required> <?php if($_POST['ok-reflection1']) echo $_POST['reflection1']; ?> </textarea>
                        <label for="reflection2" class="reflection">What was your experience with the work environment, company/management culture, and technical/innovation culture? Was it what you expected? And what would you look for in your next work opportunity that is either the same or different from this internship/work experience, from a technical or non-technical perspective? <span class="validationError"><?php if(!$_POST['ok-reflection2']) echo "*"; ?></span></label>
                        <textarea class="form-control <?php if(!$_POST['ok-reflection2']) echo "errorField"; ?>" id="reflection2" name="reflection2" rows="11" required> <?php if($_POST['ok-reflection2']) echo $_POST['reflection2']; ?> </textarea>
                        <label for="reflection3" class="reflection">With your internship experience completed, what do you plan on learning going forward into your next courses and/or next work opportunities? <span class="validationError"><?php if(!$_POST['ok-reflection3']) echo "*"; ?></span></label>
                        <textarea class="form-control <?php if(!$_POST['ok-reflection3']) echo "errorField"; ?>" id="reflection3" name="reflection3" rows="11" required> <?php if($_POST['ok-reflection3']) echo $_POST['reflection3']; ?> </textarea>
                        <label for="reflection4" class="reflection">With your internship experience completed, what would your recommendations/advice be to students who are searching for their first internship and/or are preparing to start their first internship experience? <span class="validationError"><?php if(!$_POST['ok-reflection4']) echo "*"; ?></span></label>
                        <textarea class="form-control <?php if(!$_POST['ok-reflection4']) echo "errorField"; ?>" id="reflection4" name="reflection4" rows="11" required> <?php if($_POST['ok-reflection4']) echo $_POST['reflection4']; ?> </textarea>
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
        var result = input.length == 9 && /\d{9}/.test(input);

        if (!result) {
            alert('Please ensure that Student ID is a 9-digit number!');
        }

        return result;
    }

    function isValidEmail(input) {
        var re = /^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
        return re.test(input);
    }

    function isValidDate(input) {
        return input.length == 10 && /\d{4}-[01]\d-[0-3]\d/.test(input);
    }

    function isStartDateBeforeEndDate(startDate, endDate) {
        var start = new Date(startDate);
        var end = new Date(endDate);

        var result = start <= end;

        if (!result) {
            alert('Please ensure that Start Date is on or before End Date!');
        }

        return result;
    }

    function isValidPhone(input) {
        var result = input.length == 10 && /\d{10}/.test(input);

        if (!result) {
            alert('Please ensure that phone number is a 10-digit numeric value!');
        }

        return result;
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
                      && isValidPhone($('#student-phone'))
                      && isValidDate($('#start-date').val())
                      && isValidDate($('#end-date').val())
                      && isStartDateBeforeEndDate($('#start-date').val(), $('#end-date').val())
                      && $.isNumeric($('#hours-worked').val())
                      && isValidEmail($('#supervisor-email').val())
                      && isValidPhone($('#supervisor-phone'));

        return isValidForm;
    }
</script>
</body>
</html>