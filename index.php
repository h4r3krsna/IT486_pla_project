<?php

require 'vendor/autoload.php';

function ln() {
    echo '<br>';
}

$f3 = \Base::instance();

$f3->route('GET /',
  function() {
    //echo 'Welcome to the Prior Learning Assessment Request Form!';

    $view = new View;
    echo $view->render('views/student_form.php');
  }
);

$f3->route('POST /',
    function() {
        // validate, sanitize and save to DB

        // if (allOK) {
        // return a confirmation
        echo 'Thank you for your submission!';
        ln();
        echo $_POST['first-name'];

        //} else { return ERRORS; }
    }
);

$f3->run();

?>