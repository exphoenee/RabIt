<?php

/*
* Added the dependencies manually
* TODO: using namespace and autoload would be better, but this project was not so large.
*/
  require_once 'view/mocks/mocks.php';

  require_once 'config.php';
  require_once 'request.php';

  require_once 'model/database.php';
  require_once 'model/sql.php';

  require_once 'controller/controller.php';
  require_once 'controller/advertcontroller.php';
  require_once 'controller/usercontroller.php';

  require_once 'view/view.php';
  require_once 'view/tableview.php';
  require_once 'view/selectview.php';
  require_once 'view/homeview.php';
  require_once 'view/userview.php';
  require_once 'view/advertview.php';

?>