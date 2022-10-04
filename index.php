<?php
// header
include_once 'Template/header.php';

// include the MVC
include_once 'Model/Model.php';
include_once 'Controller/Controller.php';
include_once 'View/View.php';

$model = new Model(); // connect to the database
$controller = new Controller($model);
$view = new View($controller, $model);

if(!empty($_GET['action']))
{
    $view->output();
}
else // main index page
{
    header("Location: index.php?action=index");
}

// footer
include_once 'Template/footer.php';