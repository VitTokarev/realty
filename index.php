<?
error_reporting(E_ALL);

require_once "system/model.class.php";
require_once "system/helper/array.helper.php";
require_once "model/function_realty.php";
require_once "model/function_realty_type.php";
require_once "functions.php";


spl_autoload_register('class_autoloader');

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

// if (file_exists("controller/{$controller}.php"))
// {
    // require_once "controller/{$controller}.php";
// }
// else
// {
    // die("404");
// }

$controller_class_name = name2controller_class_name($controller); //ControllerRealty

echo '<br><br>index.php: $controller_class_name = ';
echo $controller_class_name;
echo '<br><br>';

$controller_function_name = $controller_action."_controller"; //all_lines_controller

echo '<br><br>index.php: $controller_function_name = ';
echo $controller_function_name;
echo '<br><br>';

$controller_object = new $controller_class_name();  //New ControllerRealty()


$result = $controller_object->$controller_function_name(); //New ControllerRealty() {function all_lines_controller}
if ($result) echo $result;

// if (function_exists($controller_function_name))
// {
    // $result = $controller_function_name();
	// if ($result) echo $result;
// }
// else
// {
    // die ('404');
// }




