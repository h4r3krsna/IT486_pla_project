<?php

require 'vendor/autoload.php';
use \setasign\Fpdi;

$f3 = \Base::instance();
$f3->set('DEBUG', 5);

// TODO: consider moving these to constants.php to call require_once here
define("DOMAIN", "http://msreedaran.greenrivertech.net/plaform/");
// TODO: define a collection of endpoints
define('SELECT_QUERY','SELECT * FROM entries WHERE id=');

// TODO: consider turning these into constants
$f3->set("instructorEmail", "msreedaran@mail.greenriver.edu");
$f3->set('entryViewURL', DOMAIN . 'entries/');
$f3->set('approvalURL', DOMAIN . 'approve/');

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

function generatePDF($f3) {
    $pdf = new Fpdi\Fpdi();
    $pages_count = $pdf->setSourceFile("assets/plaform_it378_blank.pdf");

    $formFields = json_decode(file_get_contents("assets/plaform_fields.json"));
    //print_r($formFields);

    $tplIdx = $pdf->importPage(1);
    $pdf->addPage();
    $pdf->useTemplate($tplIdx);

    $pdf->SetFont('Arial');
    $pdf->SetTextColor(0,0,0);
    $pdf->SetXY(45,51);
    $pdf->Write(0,$f3->get('studentname'));
    $pdf->SetXY(140,51);
    $pdf->Write(0, $f3->get('studentid'));
    $pdf->SetXY(40,63);
    $pdf->Write(0, $f3->get('studentphone'));
    $pdf->SetXY(105,63);
    $pdf->Write(0, $f3->get('studentemail'));
    $pdf->Output();

    /*
        for ($j = 0; $j < count($formFields->pages[0]->areas); $j++) {
            $area = $formFields->pages[0]->areas[$j];
            $x    = $area->x;
            $y    = $area->y;
            $w    = $area->width;
            $h    = $area->height;

            // Draw blue rect at bounds
            $pdf->SetDrawColor(0, 0, 255);
            $pdf->SetLineWidth(0.2835
            $pdf->Rect($x, $y, $w, $h);

    /*
            $pdf->SetLineWidth(1.0); // border

            $iw       = $w - 2 /* 2 x 1 \* ;
            $v        = utf8_decode($area->name);
            //echo 'v... ' . $v;
            $v        = $f3->get($v);
            //echo 'f3.get... ' . $v;
            $overflow = ($pdf->GetStringWidth($v) > $iw);
            while ($pdf->GetStringWidth($v) > $iw) {
                $v = substr($v, 0, -1);
            }
            if ($overflow) {
                $v = substr($v, 0, -1) . "\\";
            }

            $pdf->SetXY($x, $y);

    //        $pdf->Write($w, $v);
    //        $pdf->MultiCell($w, intval($h), $v, true);
        }

        //$pdf->Output("test-dhek.pdf", "F");*/
    return $pdf;
}

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

$f3->route('GET /trytemplate',
  function($f3, $params) {
    $f3->set('trytemplatevar', 'hello');
    echo Template::instance()->render('views/trytemplate.php');
    $f3->clear('trytemplatevar');
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
            $entryURL = $f3->get('entryViewURL') . $entryID;
            $messageToInstructor = "Visit " . $entryURL . " to see the details of the form submission.";
            mail($f3->get("instructorEmail"), "New PLA Request Form Submission", $messageToInstructor);

            // To send HTML mail, the Content-type header must be set
            $headers[] = 'MIME-Version: 1.0';
            $headers[] = 'Content-type: text/html; charset=utf-8';

            // Additional headers
//            $headers[] = 'To: ' . $firstName . ' ' . $lastName . ' <' . $studentEmail . '>';
//            $headers[] = 'From: Automated Sender <noreply@greenrivertech.net>';
            
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
            $messageToStudent .= '<p><b>With your internship experience completed, what would your recommendations/advice be to students who are searching for their first internship and/or are preparing to start their first internship experience?</b><br>' . $reflection4 . '</p>';
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

$f3->route('POST /entries/@id',
    function($f3) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // TODO: create authentication roles in a database table and look up a match
        if (!(strcmp($username, 'admin') || strcmp($password, 'nimdadrowssap'))) {

            $f3->set('SESSION.authenticated', true);

            $entryId = $f3->get('PARAMS.id');
            if (intval($entryId) > 0) {
                $statement = SELECT_QUERY . $entryId;

                // TODO: make the credentials configurable outside of this block
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

                // TODO: create a PHP native object to model the record
                if ($row != NULL) {
                    $f3->set("studentid", $row['studentid']);
                    $f3->set("firstname", $row['firstname']);
                    $f3->set("lastname", $row['lastname']);
                    $f3->set("studentname", $row['firstname'] . ' ' . $row['lastname']);
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
                    //TODO: switch to using Template::instance() and {{ }} notation
                }

                // if record found, show form with filled fields
                // else show

                // if role = intructor, show approve button
                // if ($params['role'] === "instructor") ...
            }

            //$f3->clear('entryId');
        } else {
            echo View::instance()->render('views/top.php');
            echo "<h1>Authentication failed!</h1>";
            echo '<p><a onclick="window.history.back()">Go back</a></p>';
            echo View::instance()->render('views/bottom.php');
        }
    }
);

$f3->route('GET /entries/@id',
    function($f3) {
        $f3->set('SESSION.authenticated', false); // require authentication each time a form submission is opened
        $f3->set('entryId', $f3->get('PARAMS.id'));
//        echo 'Please enter your credentials to view entry # ' . $f3->get('PARAMS.id'); ln();
        echo View::instance()->render('views/auth.php');
    }
);

$f3->route('GET /approve/@id',
    function($f3) {
        if ($f3->get('SESSION.authenticated')) {
            // TODO: store the record's model object to the session in 'GET /entries/@id'; unset it when entering 'GET /entries/@id' and when leaving 'GET /approve/@id'

            $entryId = $f3->get('PARAMS.id');
            if (intval($entryId) > 0) {
                $statement = SELECT_QUERY . $entryId;

                // TODO: make the credentials configurable outside of this block
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

                // TODO: create a PHP native object to model the record
                if ($row != NULL) {
                    $f3->set("studentid", $row['studentid']);
                    $f3->set("firstname", $row['firstname']);
                    $f3->set("lastname", $row['lastname']);
                    $f3->set("studentname", $row['firstname'] . ' ' . $row['lastname']);
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

//                    echo "Student ID: " . $f3->get('studentid'); ln();
//                    echo "First Name: " . $f3->get('firstname');
                    $pdf = generatePDF($f3);
                    //$pdf->Output("test-dhek.pdf", "F");
                }
            }

            $f3->set('SESSION.authenticated', false); // "log out" after generating PDF so new
        } else {
            echo 'Please <a href="' . $f3->get('entryViewURL') . $f3->get('PARAMS.id') . '">sign in</a> to view/approve this entry.';
        }
    }
);

// DEPRECATED
$f3->route('GET /tryfpdf', function() {
//    tryfpdf();
    tryfpdi();
});

// DEPRECATED
$f3->route('GET /foo', function() {
   echo "foo";
});

// DEPRECATED
$f3->route('GET /bar',
    function($f3, $params) {
        echo "bar";
    }
);

$f3->run();

?>
