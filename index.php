<?php
session_start();

include('config.php');
include('controllers/controller.php');
include('controllers/pages_controller.php');
include('controllers/users_controller.php');
include('models/model.php');
include('models/users.php');

$controller = new controller;
$url = explode('index.php/',$_SERVER['PHP_SELF']);

if (count($url)<=1){
	$controller->get_route(HOMEPAGE);
} else {
	$controller->get_route($url[1]);
}


?>


<a href=<?php echo SITE_ROOT ?>>Inicio</a>
<a href=<?php echo SITE_ROOT.'/index.php/users/logout' ?>>Log out</a>



<?php
unset($_SESSION['error']);
?>