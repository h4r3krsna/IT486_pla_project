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
        .validationError {
            color: orangered;
            font-style: italic;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Prior Learning Assessment Request Form</h1>
    <form id="plaform" name="plaform" onsubmit="return validateForm()" method="POST">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <div class="form-group">
                    <fieldset>
                        <legend>Personal Identification</legend>
                        <label for="student-id">Student ID#:</label>
                        <input type="numberr" class="form-control" id="student-id" name="student-id" placeholder="XXXXXXXXX" requiredd>
                        <label for="first-name">First Name:</label>
                        <input type="text" class="form-control" id="first-name" name="first-name" placeholder="" requiredd">
                        <label for="last-name">Last Name:</label>
                        <input type="text" class="form-control" id="last-name" name="last-name" placeholder="" requiredd>
                        <label for="student-email">Student Email:</label>
                        <input type="emaill" class="form-control" id="student-email" name="student-email" placeholder="" requiredd>
                    </fieldset>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <div class="form-group">
                    <fieldset>
                        <legend>Internship Information</legend>
                        <label for="internship-title">Internship Title:</label>
                        <input type="text" class="form-control" id="internship-title" name="internship-title" placeholder="" requiredd>
                        <label for="company">Company:</label>
                        <input type="text" class="form-control" id="company" name="company" placeholder="" requiredd>
                        <label for="start-date">Start Date:</label>
                        <input type="date" class="form-control" id="start-date" name="start-date" requiredd>
                        <label for="end-date">End Date:</label>
                        <input type="date" class="form-control" id="end-date" name="end-date" requiredd>
                        <label for="hours-worked">Hours Worked:</label>
                        <input type="numberr" class="form-control" id="hours-worked" name="hours-worked" placeholder="" requiredd>
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
                        <input type="text" class="form-control" id="supervisor-name" name="supervisor-name" placeholder="" requiredd>
                        <label for="supervisor-title">Supervisor Title:</label>
                        <input type="text" class="form-control" id="supervisor-title" name="supervisor-title" placeholder="" requiredd>
                        <label for="supervisor-email">Supervisor Email:</label>
                        <input type="emaill" class="form-control" id="supervisor-email" name="supervisor-email" placeholder="" requiredd>
                        <label for="supervisor-phone">Supervisor Phone:</label>
                        <input type="numberr" class="form-control" id="supervisor-phone" name="supervisor-phone" placeholder="XXXXXXXXXX" requiredd>
                    </fieldset>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <div class="form-group">
                    <fieldset>
                        <legend>Description of Duties</legend>
                        <textarea class="form-control" id="duties-description" name="duties-description" rows="11" requiredd></textarea>
                    </fieldset>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="form-group">
                    <fieldset>
                        <legend>Additional Questions</legend>
                        <label for="reflection0">What elements and experiences from your coursework best helped you prepare for your internship experience? Your answer may include technical and non-technical elements.</label>
                        <textarea class="form-control" id="reflection0" name="reflection0" rows="11" requiredd></textarea>
                        <label for="reflection1" class="reflection">What did you learn in your internship experience, either directly at work or independently to support your work? Your answer may include technical and non-technical items.</label>
                        <textarea class="form-control" id="reflection1" name="reflection1" rows="11" requiredd></textarea>
                        <label for="reflection2" class="reflection">What was your experience with the work environment, company/management culture, and technical/innovation culture? Was it what you expected? And what would you look for in your next work opportunity that is either the same or different from this internship/work experience, from a technical or non-technical perspective?</label>
                        <textarea class="form-control" id="reflection2" name="reflection2" rows="11" requiredd></textarea>
                        <label for="reflection3" class="reflection">With your internship experience completed, what do you plan on learning going forward into your next courses and/or next work opportunities?</label>
                        <textarea class="form-control" id="reflection3" name="reflection3" rows="11" requiredd></textarea>
                        <label for="reflection4" class="reflection">With your internship experience completed, what would your recommendations/advice be to students who are searching for their first internship and/or are preparing to start their first internship experience?</label>
                        <textarea class="form-control" id="reflection4" name="reflection4" rows="11" requiredd></textarea>
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
                      && isValidDate($('#start-date').val())
                      && isValidDate($('#end-date').val())
                      && isStartDateBeforeEndDate($('#start-date').val(), $('#end-date').val())
                      && $.isNumeric($('#hours-worked').val())
                      && isValidEmail($('#supervisor-email').val())
                      && isValidPhone($('#supervisor-phone').val());

        return isValidForm;
    }
</script>
</body>
</html>