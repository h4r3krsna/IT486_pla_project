<?php

require 'vendor/autoload.php';
use \setasign\Fpdi;

function ln() {
    echo '<br>';
}

function isValidStudentID(&$postData) {
    $studentId = $postData['student-id'];
    $matches = '';
    preg_match('/[0-9]{9}/', $studentId,$matches);

    $result = (strlen($studentId) == 9) && (sizeof($matches) == 1);

    $postData['ok-student-id'] = $result;
    return $result;
}

function isFilled(&$postData, $fieldName) {
    $result = strlen($postData[$fieldName]) > 0;

    $postData['ok-' . $fieldName] = $result;
    return result;
}

function isValidEmail(&$postData, $fieldName) {
    $email = $postData[$fieldName];

    $result = strlen(filter_var($email, FILTER_VALIDATE_EMAIL)) > 0;

    $postData['ok-' . $fieldName] = $result;
    return $result;
}

function isValidDate(&$postData, $fieldName) {
    $date = $postData[$fieldName];
    $matches = '';
    preg_match('/[0-9]{4}-[01][0-9]-[0-3][0-9]/', $date, $matches);

    $result = (strlen($date) == 10) && (sizeof($matches) == 1);

    $postData['ok-' . $fieldName] = $result;
    return $result;
}

function isStartDateBeforeEndDate(&$postData) {
    $startDate = date_create($postData['start-date']);
    $endDate = date_create($postData['end-date']);

    $result = !(date_diff($startDate, $endDate)->format("%R%a") < 0);

    $postData['ok-dates'] = $result;
    return $result;
}

function isNumeric(&$postData, $fieldName) {
    $result = is_numeric($postData[$fieldName]);

    $postData['ok-' . $fieldName] = $result;
    return $result;
}

function isValidPhone(&$postData, $fieldName) { // TODO: validate
    $phoneNumber = $postData[$fieldName];
    $matches = '';
    preg_match('/[0-9]{10}/', $phoneNumber, $matches);

    $result = strlen($phoneNumber) == 10 && (sizeof($matches) == 1);

    $postData['ok-' . $fieldName] = $result;
    return $result;
}

function isValidForm(&$postData) {
  $isValidForm = true;

  // split into individual statements so that all validators will be executed instead of
  // being shortcircuited

  $isValidForm = isValidStudentID($postData) && $isValidForm;
  $isValidForm = isFilled($postData, 'first-name') && $isValidForm;
  $isValidForm = isFilled($postData, 'last-name') && $isValidForm;
  $isValidForm = isValidEmail($postData, 'student-email') && $isValidForm;
  $isValidForm = isValidPhone($postData, 'student-phone') && $isValidForm;
  $isValidForm = isFilled($postData, 'internship-title') && $isValidForm;
  $isValidForm = isFilled($postData, 'company') && $isValidForm;
  $isValidForm = isValidDate($postData, 'start-date') && $isValidForm;
  $isValidForm = isValidDate($postData, 'end-date') && $isValidForm;
  $isValidForm = isStartDateBeforeEndDate($postData) && $isValidForm;
  $isValidForm = isNumeric($postData, 'hours-worked') && $isValidForm;
  $isValidForm = isFilled($postData, 'supervisor-name') && $isValidForm;
  $isValidForm = isFilled($postData, 'supervisor-title') && $isValidForm;
  $isValidForm = isValidEmail($postData, 'supervisor-email') && $isValidForm;
  $isValidForm = isValidPhone($postData, 'supervisor-phone') && $isValidForm;
  $isValidForm = isFilled($postData, 'duties-description') && $isValidForm;
  $isValidForm = isFilled($postData, 'reflection0') && $isValidForm;
  $isValidForm = isFilled($postData, 'reflection1') && $isValidForm;
  $isValidForm = isFilled($postData, 'reflection2') && $isValidForm;
  $isValidForm = isFilled($postData, 'reflection3') && $isValidForm;
  $isValidForm = isFilled($postData, 'reflection4') && $isValidForm;

  return $isValidForm;
}

function tryfpdf() {
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial','B',16);
    $pdf->Cell(40,10,'Hello World!');
    $pdf->Output();
}

function tryfpdi() {
    $pdf = new Fpdi\Fpdi();
    $pages_count = $pdf->setSourceFile("assets/plaform_blank.pdf");
    $tplIdx = $pdf->importPage(1);
    $pdf->addPage();
    $size = $pdf->useTemplate($tplIdx);
    $pdf->SetFont('Arial');
    $pdf->SetTextColor(0,0,0);
    $pdf->SetXY(45,51);
    $pdf->Write(0,"Hello World!");
    $pdf->SetXY(140,51);
    $pdf->Write(0, "123456789");
    $pdf->Output();
}

$f3 = \Base::instance();

$f3->set('DEBUG', 5);

$f3->set("instructorEmail", "msreedaran@mail.greenriver.edu");

$f3->route('GET /test/foo',
    function() {
        echo "test";
});

$f3->route('GET /',
  function() {
    $view = new View;
    echo $view->render('views/student_form.php');
  }
);

$f3->route('POST /',
    function($f3) {
//        print_r($_POST);
//        ln();

//        foreach($_POST as $key => $value)
//        {
//            print_r($value . ' : ' . gettype($value));
//            ln();
//        }

        if (!isValidForm($_POST)) {
            // set POST variables for bad fields
            // render a variant of student_form.php that will later be merged into student_form.php
            echo View::instance()->render('views/student_form_invalid.php');
            return;
        }


        $dbConnection = new mysqli("localhost", //$this->f3->get("dbservername"),
            "request_plaform", //$this->f3->get("dbuser"),
            "plaform",//$this->f3->get("dbpassword"),
            "request_plaform");//$this->f3->get("databasename"));
        if ($dbConnection->connect_errno) {
            printf("DB connection failed: %s\n", $dbConnection->connect_error);
            exit();
        }

        $studentId = $dbConnection->escape_string($_POST["student-id"]);
        $firstName = $dbConnection->escape_string($_POST["first-name"]);
        $lastName = $dbConnection->escape_string($_POST["last-name"]);
        $studentEmail = $dbConnection->escape_string($_POST["student-email"]);
        $studentPhone = $dbConnection->escape_string($_POST["student-phone"]);
        $internshipTitle = $dbConnection->escape_string($_POST["internship-title"]);
        $company = $dbConnection->escape_string($_POST["company"]);
        $startDate = $dbConnection->escape_string($_POST["start-date"]);
        $endDate = $dbConnection->escape_string($_POST["end-date"]);
        $hoursWorked = $dbConnection->escape_string($_POST["hours-worked"]);
        $supervisorName = $dbConnection->escape_string($_POST["supervisor-name"]);
        $supervisorTitle = $dbConnection->escape_string($_POST["supervisor-title"]);
        $supervisorEmail = $dbConnection->escape_string($_POST["supervisor-email"]);
        $supervisorPhone = $dbConnection->escape_string($_POST["supervisor-phone"]);
        $dutiesDescription = $dbConnection->escape_string($_POST["duties-description"]);
        $reflection0 = $dbConnection->escape_string($_POST["reflection0"]);
        $reflection1 = $dbConnection->escape_string($_POST["reflection1"]);
        $reflection2 = $dbConnection->escape_string($_POST["reflection2"]);
        $reflection3 = $dbConnection->escape_string($_POST["reflection3"]);
        $reflection4 = $dbConnection->escape_string($_POST["reflection4"]);

        $statement = "INSERT INTO entries (studentid, firstname, lastname, email, phone,"
                     . " internshiptitle, company, startdate,enddate,hoursworked,"
                     . "supervisorname,supervisortitle, supervisoremail,supervisorphone,"
                     . "descriptionofduties,"
                     . "reflection0, reflection1, reflection2, reflection3, reflection4)"
                     . " VALUES ("
                     . "'" . $studentId . "',"
                     . "'" . $firstName . "',"
                     . "'" . $lastName . "',"
                     . "'" . $studentEmail . "', "
                     . "'" . $studentPhone . "', "
                     . "'" . $internshipTitle . "', "
                     . "'" . $company . "', "
                     . "'" . $startDate . "', "
                     . "'" . $endDate . "', "
                     . $hoursWorked . ", "
                     . "'" . $supervisorName . "', "
                     . "'" . $supervisorTitle . "', "
                     . "'" . $supervisorEmail . "', "
                     . "'" . $supervisorPhone . "', "
                     . "'" . $dutiesDescription . "', "
                     . "'" . $reflection0 . "', "
                     . "'" . $reflection1 . "', "
                     . "'" . $reflection2 . "', "
                     . "'" . $reflection3 . "', "
                     . "'" . $reflection4 . "'"
                     . ")";
//            echo $statement;

        $entryID = '';
        if ($dbConnection->query($statement) === TRUE) {
            $entryID = $dbConnection->insert_id;
            $entryURL = "http://request.greenrivertech.net/entries/" . $entryID;
            $messageToInstructor = "Visit http://request.greenrivertech.net/entries/" . $entryID . " to see the details of the form submission.";
            mail($f3->get("instructorEmail"), "New PLA Request Form Submission", $messageToInstructor);

            // To send HTML mail, the Content-type header must be set
            $headers[] = 'MIME-Version: 1.0';
            $headers[] = 'Content-type: text/html; charset=utf-8';

            // Additional headers
            $headers[] = 'To: ' . $firstName . ' ' . $lastName . ' <' . $studentEmail . '>';
//            $headers[] = 'From: Green River P <noreply@greenrivertech.net>';
            
            $subject = "Prior Learning Assessment Request Form Submission";
            
            $thanks = 'Thank you for your submission!';
            $messageToStudent = '<html><head><title>' . $subject . '</title></head><body><p>' . $thanks . '<br>';
            $messageToStudent .= 'Here are the details of your form submission.</p>';
            $messageToStudent .= '<h3>Personal Identification</h3><p>';
            $messageToStudent .= 'Student ID#: ' . $studentId . '<br>';
            $messageToStudent .= 'First Name: ' . $firstName . '<br>';
            $messageToStudent .= 'Last Name: ' . $lastName . '<br>';
            $messageToStudent .= 'Student Email: ' . $studentEmail . '<br>';
            $messageToStudent .= 'Student Phone: ' . $studentPhone . '<br>';
            $messageToStudent .= '</p><h3>Internship Information</h3><p>';
            $messageToStudent .= 'Internship Title: ' . $internshipTitle . '<br>';
            $messageToStudent .= 'Company: ' . $company . '<br>';
            $messageToStudent .= 'Start Date: ' . $startDate . '<br>';
            $messageToStudent .= 'End Date: ' . $endDate . '<br>';
            $messageToStudent .= 'Hours Worked: ' . $hoursWorked . '<br>';
            $messageToStudent .= '</p><h3>Supervisor Details</h3><p>';
            $messageToStudent .= 'Supervisor Name: ' . $supervisorName . '<br>';
            $messageToStudent .= 'Supervisor Title: ' . $supervisorTitle . '<br>';
            $messageToStudent .= 'Supervisor Email: ' . $supervisorEmail . '<br>';
            $messageToStudent .= 'Supervisor Phone: ' . $supervisorPhone . '<br>';
            $messageToStudent .= '</p><p><b>Description of Duties:</b><br>' . $dutiesDescription;
            $messageToStudent .= '</p><h3>Additional Questions</h3>';
            $messageToStudent .= '<p><b>What elements and experiences from your coursework best helped you prepare for your internship experience? Your answer may include technical and non-technical elements.</b><br>' . $reflection0 . '</p>';
            $messageToStudent .= '<p><b>What did you learn in your internship experience, either directly at work or independently to support your work? Your answer may include technical and non-technical items.</b><br>' . $reflection1 . '</p>';
            $messageToStudent .= '<p><b>What was your experience with the work environment, company/management culture, and technical/innovation culture? Was it what you expected? And what would you look for in your next work opportunity that is either the same or different from this internship/work experience, from a technical or non-technical perspective?</b><br>' . $reflection2 . '</p>';
            $messageToStudent .= '<p><b>With your internship experience completed, what do you plan on learning going forward into your next courses and/or next work opportunities?</b><br>' . $reflection3 . '</p>';
            $messageToStudent .= '<p><b>With your internship experience completed, what would your recommendations/advice be to students who are searching for their first internship and/or are preparing to start their first internship experience?</b><br>' . $reflection4 . '\r\n';
            $messageToStudent .= '</body></html>';
            mail($_POST['student-email'], $subject, $messageToStudent, implode("\r\n", $headers));

            echo '<span id="confirmation">' . $thanks; ln();
            echo 'Please check your email for a receipt with the details'; ln();
            echo 'that you entered in your form submission.</span>';
            //echo "<a href=\"" . $entryURL . "\">Click Here</a> to see the details of the form submission.";
        } else {
            echo "Error: " . $statement;
            ln();
            echo $dbConnection->error;
        }

        $dbConnection->close();
    }
);

$f3->route('GET /entries/@id',
    function($f3, $params) {
        $entryId = $params['id'];
        if (intval($entryId) > 0) {
            $statement = 'SELECT * FROM entries WHERE id=' . $entryId;

            $dbConnection = new mysqli("localhost", //$this->f3->get("dbservername"),
                "request_plaform", //$this->f3->get("dbuser"),
                "plaform",//$this->f3->get("dbpassword"),
                "request_plaform");//$this->f3->get("databasename"));
            if ($dbConnection->connect_errno) {
                printf("DB connection failed: %s\n", $dbConnection->connect_error);
                exit();
            }

            $result = $dbConnection->query($statement);
            $row = $result->fetch_assoc();

            if ($row != NULL) {
                $f3->set("studentid", $row['studentid']);
                $f3->set("firstname", $row['firstname']);
                $f3->set("lastname", $row['lastname']);
                $f3->set("studentemail", $row['email']);
                $f3->set("studentphone", $row['phone']);
                $f3->set("internshiptitle", $row['internshiptitle']);
                $f3->set("company", $row['company']);
                $f3->set("startdate", $row['startdate']);
                $f3->set("enddate", $row['enddate']);
                $f3->set("hoursworked", $row['hoursworked']);
                $f3->set("supervisorname", $row['supervisorname']);
                $f3->set("supervisortitle", $row['supervisortitle']);
                $f3->set("supervisoremail", $row['supervisoremail']);
                $f3->set("supervisorphone", $row['supervisorphone']);
                $f3->set("dutiesdescription", $row['descriptionofduties']);
                $f3->set("reflection0", $row['reflection0']);
                $f3->set("reflection1", $row['reflection1']);
                $f3->set("reflection2", $row['reflection2']);
                $f3->set("reflection3", $row['reflection3']);
                $f3->set("reflection4", $row['reflection4']);

                echo View::instance()->render('views/approval_form.php');
            }

            // if record found, show form with filled fields
            // else show

            // if role = intructor, show approve button
            // if ($params['role'] === "instructor") ...
        }
    }
);

$f3->route('GET /tryfpdf', function() {
//    tryfpdf();
    tryfpdi();
});

$f3->route('GET /foo', function() {
   echo "foo";
});

$f3->route('GET /bar',
    function($f3, $params) {
        echo "bar";
    }
);

$f3->run();

?>
