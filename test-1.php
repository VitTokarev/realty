<?
require_once "system/model.class.php";
require_once "model/function_realty_type.php";

class Test extends Model
{
	public static function all_lines()
	{
		$realty = parent::all_lines();
		
		echo '<br><br>function_realty.php parent::all_lines() =';//
		var_dump($realty);//
		echo '<br><br>';//
		
		$types = RealtyType::all_lines();
		
		echo '<br><br>function_realty.php RealtyType::all_lines() =';//
		var_dump($types);//
		echo '<br><br>';//
	}
	
	
}

$r = new Test();
$r -> all_lines();