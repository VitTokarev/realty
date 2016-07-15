<?

error_reporting(E_ALL);

class ControllerRealtyType 
{
	function __call($name,$params)
    {
        e404();
    }

//Выборка всех типов

	public static function all_types_controller()
	{
		if(ISSET($_POST['esc_submit']))
		{	
			header("Location: index.php");
			return;
		}	
		
		if(ISSET($_POST['add_type']))
		{	
			header("Location: index.php?redirect=add_type&controller=controller_realty_type");
			return;
		}	
		
		$realty_types = RealtyType::all_lines();
	
		return render("main_type_content",['realty_types' => $realty_types]);
	}
	
	//Добавление типа
	
	public static function add_type_controller()
	{
		if(ISSET($_POST['esc_submit']))
		{	
			header("Location: index.php?redirect=all_types&controller=controller_realty_type");
			return;
		}	
		
		if(ISSET($_POST['add_type']))
		{	
			$type = $_POST['type'];
			RealtyType::add_type($type);
			header("Location: index.php?redirect=all_types&controller=controller_realty_type");
			return;
		}	
		
		return render("add_type_content");
	}
	
	
	//Редактирование типа
	
	public static function edite_type_controller()
	{
		if(ISSET($_POST['esc_submit']))
		{	
			header("Location: index.php?redirect=all_types&controller=controller_realty_type");
			return;
		}	
		
		if(ISSET($_POST['edite_type']))
		{	
			$type_id = $_GET['type_id'];
			$type = $_POST['type'];
			RealtyType::edite_type($type_id, $type);
			header("Location: index.php?redirect=all_types&controller=controller_realty_type");
			return;
		}	
		
		$type_id = $_GET['type_id'];
		$realty_type = RealtyType::one_type($type_id);
		
		return render("realty_types_edite_content",['realty_type' => $realty_type]);
	}
	
	//Удаление типа
	
	public static function delete_type_controller()
	{
	
		if(ISSET($_POST['esc_submit']))
		{	
			header("Location: index.php?redirect=all_types&controller=controller_realty_type");
			return;
		}	
		
		if(ISSET($_POST['delete_type']))
		{	
			$type_id = $_GET['type_id'];
			$all_lines_of_type = RealtyType::all_lines_of_type($type_id);	
			if(ISSET($all_lines_of_type[0]['type_id']))
			{	
				require 'teamplates/existing_type_not_delete_content.php';		
				return;
			}	
			RealtyType::delete_type($type_id);
			header("Location: index.php?redirect=all_types&controller=controller_realty_type");
			return;		
			
			
		}	
		
		$type_id = $_GET['type_id'];
		$realty_type = RealtyType::one_type($type_id);
		
		return render("realty_type_delete_content",['realty_type' => $realty_type]);
	}

}





