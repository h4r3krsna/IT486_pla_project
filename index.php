<?php

require 'vendor/autoload.php';

$f3 = \Base::instance();

$f3->route('GET /',
  function() {
    //echo 'Welcome to the Prior Learning Assessment Request Form!';

    $view = new View;
    echo $view->render('views/student_form.php');
  }
);

$f3->run();

?>