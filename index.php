<?php

require 'vendor/autoload.php';

function ln() {
    echo '<br>';
}

function isValidStudentID($input) {
    $matches = '';
    preg_match('/[0-9]{9}/', $input,$matches);
    return (strlen($input) == 9) && (sizeof($matches) == 1);
}

function isValidEmail($input) {

}

function isValidDate($input) {
    $matches = '';
    preg_match('/[0-9]{4}-[01][0-9]-[0-3][0-9]/', $input, $matches);
    return (strlen($input) == 10) && (sizeof($matches) == 1);
}

function isValidPhone($input) {

}

function isValidForm($postData) {
  $isValidForm = true;

//  foreach($postData as $key => $value) {
//    $isValidForm = $isValidForm &&
//  }

  return $isValidForm;
}

$f3 = \Base::instance();

$f3->set("instructorEmail", "msreedaran@mail.greenriver.edu");

$f3->route('GET /',
  function() {
    $view = new View;
    echo $view->render('views/student_form.php');
  }
);

$f3->route('POST /',
    function($f3) {
        print_r($_POST);
        ln();

        foreach($_POST as $key => $value)
        {
//            print_r($value . ' : ' . gettype($value));
//            ln();
        }

        if (isValidForm($_POST)) {

            // validate, sanitize and save to DB
            $dbConnection = new mysqli("localhost", //$this->f3->get("dbservername"),
                "msreedar_plaform", //$this->f3->get("dbuser"),
                "plaform",//$this->f3->get("dbpassword"),
                "msreedar_plaform");//$this->f3->get("databasename"));
            if ($dbConnection->connect_errno) {
                printf("DB connection failed: %s\n", $dbConnection->connect_error);
                exit();
            }

            $studentId = $dbConnection->escape_string($_POST["student-id"]);
            $firstName = $dbConnection->escape_string($_POST["first-name"]);
            $lastName = $dbConnection->escape_string($_POST["last-name"]);
            $studentEmail = $dbConnection->escape_string($_POST["student-email"]);
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

            // how to get id of last insert https://www.w3schools.com/php/php_mysql_insert_lastid.asp
            $statement = "INSERT INTO entries (studentid, firstname, lastname, email, internshiptitle, company, startdate,enddate,hoursworked,supervisorname,supervisortitle, supervisoremail,supervisorphone, descriptionofduties) VALUES ("
                         . "'" . $studentId . "',"
                         . "'" . $firstName . "',"
                         . "'" . $lastName . "',"
                         . "'" . $studentEmail . "', "
                         . "'" . $internshipTitle . "', "
                         . "'" . $company . "', "
                         . "'" . $startDate . "', "
                         . "'" . $endDate . "', "
                         . $hoursWorked . ", "
                         . "'" . $supervisorName . "', "
                         . "'" . $supervisorTitle . "', "
                         . "'" . $supervisorEmail . "', "
                         . "'" . $supervisorPhone . "', "
                         . "'" . $dutiesDescription . "'"
                         . ")";
            echo $statement;

            $entryID = '';
            if ($dbConnection->query($statement) === TRUE) {
                $entryID = $dbConnection->insert_id;
            } else {
                echo "Error: " . $statement;
                ln();
                echo $dbConnection->error;
            }

            $dbConnection->close();

            echo 'Thank you for your submission!';// . 'Your entry ID is: ' . $entryID;

            // ln(); echo '<a href="http://msreedaran.greenrivertech.net/plaform/entries/1

            // TODO: email the instructor with a link to the entry & return a confirmation to the student
            $message = "<a href=\"http://msreedaran.greenrivertech.net/plaform/entries/" . $entryID . "\">Click Here</a> to see the details of the form submission.";
            mail($f3->get("instructorEmail"), "New PLA Request Form Submission", $message);
        } else {
            echo "INVALID FORM SUBMISSION DATA";
        }
    }
);

$f3->route('GET /entries/@id',
    function($f3, $params) {
        $entryId = $params['id'];
        $stmt = 'SELECT * FROM entries WHERE id=' . $entryId;
        echo $stmt;

        // if record found, show form with filled fields
        // else show
    });

$f3->run();

?>