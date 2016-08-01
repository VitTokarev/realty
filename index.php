<?php
error_reporting(E_ALL);

session_start();

require_once "system/system.class.php";
require_once "system/model.class.php";
require_once "system/helper/array.helper.php";
require_once "model/realty_model.php";
require_once "model/realty_type_model.php";
require_once "model/user_model.php";
require_once "functions.php";


spl_autoload_register('class_autoloader');

$system = new System();

if(isset($_GET['controller']))
{
	$controller = $_GET['controller'];
}
else
{
	$controller = "controller_realty";
}	


if(isset($_GET['redirect']))
{
	$controller_action = $_GET['redirect'];
	if(isset($_GET['id']))
	{
		$id = $_GET['id'];
	}	
}
else
{
	$controller_action = 'all_lines';
}

$controller_class_name = name2controller_class_name($controller); //ControllerRealty


$controller_function_name = $controller_action."_controller"; //all_lines_controller



$controller_object = new $controller_class_name();  //New ControllerRealty()


$result = $controller_object->$controller_function_name(); //New ControllerRealty() {function all_lines_controller}
if ($result) echo $result;

