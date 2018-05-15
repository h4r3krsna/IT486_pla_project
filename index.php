require 'vendor/autoload.php';
$f3 = \Base::instance();
$f3->route('GET /',
  function() {
    echo 'Welcome to the Prior Learning Assessment Request Form!';
  }
);
$f3->run();

