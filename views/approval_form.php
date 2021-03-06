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
        .reflection {
            margin-top: 25px;
        }
        body {
            padding-bottom: 25px;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Prior Learning Assessment Request Form</h1>
    <form id="plaform" name="plaform" action="#">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <fieldset>
                    <legend>Personal Identification</legend>
                    <div class="form-group">
                        <label for="student-id">Student ID#:</label>
                        <input type="number" class="form-control" id="student-id" name="student-id" value="<?php echo $f3->get("studentid"); ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="first-name">First Name:</label>
                        <input type="text" class="form-control" id="first-name" name="first-name" value="<?php echo $f3->get("firstname"); ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="last-name">Last Name:</label>
                        <input type="text" class="form-control" id="last-name" name="last-name" value="<?php echo $f3->get("lastname"); ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="student-email">Student Email:</label>
                        <input type="email" class="form-control" id="student-email" name="student-email" value="<?php echo $f3->get("studentemail"); ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="student-phone">Student Phone:</label>
                        <input type="text" class="form-control" id="student-phone" name="student-phone" value="<?php echo $f3->get("studentphone") ?>" disabled>
                    </div>
                </fieldset>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <fieldset>
                    <legend>Internship Information</legend>
                    <div class="form-group">
                        <label for="internship-title">Internship Title:</label>
                        <input type="text" class="form-control" id="internship-title" name="internship-title" value="<?php echo $f3->get("internshiptitle"); ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="company">Company:</label>
                        <input type="text" class="form-control" id="company" name="company" value="<?php echo $f3->get("company"); ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="start-date">Start Date:</label>
                        <input type="date" class="form-control" id="start-date" name="start-date" value="<?php echo $f3->get("startdate"); ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="end-date">End Date:</label>
                        <input type="date" class="form-control" id="end-date" name="end-date" value="<?php echo $f3->get("enddate"); ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="hours-worked">Total Hours Worked:</label>
                        <input type="number" class="form-control" id="hours-worked" name="hours-worked" value="<?php echo $f3->get("hoursworked"); ?>" disabled>
                    </div>
                </fieldset>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <fieldset>
                    <legend>Supervisor Details</legend>
                    <div class="form-group">
                        <label for="supervisor-name">Supervisor Name:</label>
                        <input type="text" class="form-control" id="supervisor-name" name="supervisor-name" value="<?php echo $f3->get("supervisorname"); ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="supervisor-title">Supervisor Title:</label>
                        <input type="text" class="form-control" id="supervisor-title" name="supervisor-title" value="<?php echo $f3->get("supervisortitle"); ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="supervisor-email">Supervisor Email:</label>
                        <input type="email" class="form-control" id="supervisor-email" name="supervisor-email" value="<?php echo $f3->get("supervisoremail"); ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="supervisor-phone">Supervisor Phone:</label>
                        <input type="number" class="form-control" id="supervisor-phone" name="supervisor-phone" value="<?php echo $f3->get("supervisorphone"); ?>" disabled>
                    </div>
                </fieldset>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <fieldset>
                    <legend>Description of Duties</legend>
                    <div class="form-group">
                        <textarea class="form-control" id="duties-description" name="duties-description" rows="11" disabled><?php echo $f3->get("dutiesdescription"); ?></textarea>
                    </div>
                </fieldset>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <fieldset>
                    <legend>Additional Questions</legend>
                    <div class="form-group">
                        <label for="reflection0">What elements and experiences from your coursework best helped you prepare for your internship experience? Your answer may include technical and non-technical elements.</label>
                        <textarea class="form-control" id="reflection0" name="reflection0" rows="11" disabled><?php echo $f3->get("reflection0"); ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="reflection1" class="reflection">What did you learn in your internship experience, either directly at work or independently to support your work? Your answer may include technical and non-technical items.</label>
                        <textarea class="form-control" id="reflection1" name="reflection1" rows="11" disabled><?php echo $f3->get("reflection1"); ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="reflection2" class="reflection">What was your experience with the work environment, company/management culture, and technical/innovation culture? Was it what you expected? And what would you look for in your next work opportunity that is either the same or different from this internship/work experience, from a technical or non-technical perspective?</label>
                        <textarea class="form-control" id="reflection2" name="reflection2" rows="11" disabled><?php echo $f3->get("reflection2"); ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="reflection3" class="reflection">With your internship experience completed, what do you plan on learning going forward into your next courses and/or next work opportunities?</label>
                        <textarea class="form-control" id="reflection3" name="reflection3" rows="11" disabled><?php echo $f3->get("reflection3"); ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="reflection4" class="reflection">With your internship experience completed, what would your recommendations/advice be to students who are searching for their first internship and/or are preparing to start their first internship experience?</label>
                        <textarea class="form-control" id="reflection4" name="reflection4" rows="11" disabled><?php echo $f3->get("reflection4"); ?></textarea>
                    </div>
                </fieldset>
            </div>
        </div>
        <button class="btn btn-primary pull-right" id="btnApprove">Approve</button>
    </form>
</div>
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script>
    $('#btnApprove').click(function() {
        window.location = "<?php echo $f3->get('approvalURL') . $f3->get('PARAMS.id'); ?>";
    });
</script>
</body>
</html>