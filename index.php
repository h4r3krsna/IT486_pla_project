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
    preg_match('', $input, $matches);
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
    function() {
        print_r($_POST);
        ln();

        foreach($_POST as $key => $value)
        {
            print_r($value . ' : ' . gettype($value));
            ln();
//            if (strstr($key, 'item'))
//            {
//                $x = str_replace('item','',$key);
//                inserttag($value, $x);
//            }
        }

        // validate, sanitize and save to DB
        $dbConnection = new mysqli("mysql:host=localhost;port=3306;dbname=msreedar_plaform", //$this->f3->get("dbservername"),
            "msreedar_plaform", //$this->f3->get("dbuser"),
            "plaform",//$this->f3->get("dbpassword"),
            "msreedar_plaform");//$this->f3->get("databasename"));

        if ($dbConnection->connect_errno) {
            printf("DB connection failed: %s\n", $dbConnection->connect_error);
            exit();
        }

        /*
        $sid = $dbConnection->escape_string($_POST["student-id"]);
        $email = $dbConnection->escape_string($email);
        $location = $dbConnection->escape_string($location);
        $phone = $dbConnection->escape_string($phone);

        $name = explode(" ", $name);
        $first_name = $name[0];
        $last_name = $name[sizeof($name) - 1];
        $phone = str_replace("-", "", $phone);

        $statement = "INSERT INTO customer (first_name, last_name, email, location, phone_number) VALUES ('". $first_name ."', '". $last_name ."', '". $email ."', '". $location . "', ";
        if (strlen($phone) == 10)
            $statement = $statement . "'" . $phone . "'";
        else
            $statement = $statement . "NULL";
        $statement = $statement . ")";
        $dbConnection->query($statement);
*/

        /*
         * INSERT INTO entries (studentid, firstname, lastname, email, internshiptitle, company, startdate,enddate,hoursworked,supervisorname,supervisortitle, supervisoremail,supervisorphone, descriptionofduties) VALUES ('123456789', 'first','last','email@mail.com','title','company',CURDATE(),CURDATE(),0,'supervisor','boss','boss@work.com','9876542310','duties duties duties duties duties duties duties duties');
         */

        // if (allOK) {
        // email the instructor with a link to the entry & return a confirmation to the student
        // TODO: how to get id of last insert https://www.w3schools.com/php/php_mysql_insert_lastid.asp
        // echo '<a href="http://msreedaran.greenrivertech.net/plaform/entries/1
        echo 'Thank you for your submission!';// . 'Your entry ID is: ' . $entryID;

        //} else { return ERRORS; }
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