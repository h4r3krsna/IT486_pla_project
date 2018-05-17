<?php

require 'vendor/autoload.php';

function ln() {
    echo '<br>';
}

$f3 = \Base::instance();

$f3->route('GET /',
  function() {
    $view = new View;
    echo $view->render('views/student_form.php');
  }
);

$f3->route('POST /',
    function() {
        // validate, sanitize and save to DB
        print_r($_POST);
        ln();

        /*
         * INSERT INTO entries (studentid, firstname, lastname, email, internshiptitle, company, startdate,enddate,hoursworked,supervisorname,supervisortitle, supervisoremail,supervisorphone, descriptionofduties) VALUES ('123456789', 'first','last','email@mail.com','title','company',CURDATE(),CURDATE(),0,'supervisor','boss','boss@work.com','9876542310','duties duties duties duties duties duties duties duties');
         */

        // if (allOK) {
        // email the instructor with a link to the entry & return a confirmation to the student
        // TODO: how to get id of last insert https://www.w3schools.com/php/php_mysql_insert_lastid.asp
        // echo '<a href="http://msreedaran.greenrivertech.net/plaform/entries/1
        echo 'Thank you for your submission!';

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