<?

error_reporting(E_ALL);

class ControllerRealty 
{
	function __call($name,$params)
    {
        e404();
    }

//Выборка всех объектов
	
	public static function all_lines_controller()
	{
		$realty = Realty::all_lines(); //function_realty.php
		
		//echo '<br><br>';// ERR
		//echo 'controller_realty.php: function all_lines_controller() Realty::all_lines() =';//
		//print_r($realty);//
		//echo '<br><br>';
		
		$types = RealtyType::all_lines();
		
		echo '<br><br>';// OK
		echo 'controller_realty.php: function all_lines_controller() RealtyType::all_lines() =';//
		var_dump($types);//
		echo '<br><br>';
		
		$types = RealtyType::type_id_array($types);
		
		echo '<br><br>';// ERR
		echo 'controller_realty.php: function all_lines_controller() RealtyType::type_id_array($types) =';//
		var_dump($types);//
		echo '<br><br>';
		
		
		return render("index_content",['realty' => $realty,
									   'realty_types' => $types
		]);
	}
	
	
	//Выборка одного объекта
	
	public static function one_line_controller()
	{
	
		if(ISSET($_POST['edite_object']))
		{	
			$id = $_GET['id'];
			header("Location: index.php?redirect=edit_line&id=$id");
			return;
		}	
		
		if(ISSET($_POST['delete_object']))
		{	
			$id = $_GET['id'];
			header("Location: index.php?redirect=delete_line&id=$id");
			return;
		}	
		
		if(ISSET($_POST['esc_submit']))
		{	
			header("Location: index.php");
			return;
		}		
		
		$id = $_GET['id'];
		$realty = Realty::one_line($id);
		
		return render("one_object_content",['realty' => $realty]);
	
	}
	
	// Добавление одного объекта
	
	public static function add_line_controller()
	{
		if(ISSET($_POST['esc_submit']))
		{	
			header("Location: index.php");
			return;
		}	
		
		if(ISSET($_POST['add_submit']))
		{	
			$type = $_POST['type'];
			$title = $_POST['title'];
			$address = $_POST['address'];
			$price = $_POST['price'];	
				
			Realty::add_line($type, $title, $address, $price);
			
			header("Location: index.php");	
			
			return;
		}	
		
		
		$realty_types = RealtyType::all_types();
		$realty = Realty::all_lines();
		
		return render("add_content",['realty_types' => $realty_types]);
	
	}
	
	//Удаление одного объекта
	
	public static function delete_line_controller()
	{
		if(ISSET($_POST['esc_submit']))
		{	
			header("Location: index.php");
			return;
		}	
		
		if(ISSET($_POST['delete']))
		{	
			
			$id = $_GET['id'];	
			Realty::delete_line($id);
			
			header("Location: index.php");
			return;
		}	
		
		$id = $_GET['id'];
		$realty = Realty::one_line($id);
		
		return render("delete_content",['realty' => $realty]);
	}
	
	//Редактирование объекта
	
	public static function edit_line_controller()
	{
	
		if(ISSET($_POST['esc_submit']))
		{	
			header("Location: index.php");
			return;
		}	
		
		if(ISSET($_POST['edite_submit']))
		{	
			$id = $_GET['id'];
			$type = $_POST['type'];
			$title = $_POST['title'];
			$address = $_POST['address'];
			$price = $_POST['price'];	
			
			Realty::edite_line($id, $type, $title, $address, $price);	
			
			header("Location: index.php");
			
			return;
		}	
		
		$id = $_GET['id'];
		$realty = Realty::one_line($id);
		$realty_types = RealtyType::realty_types_for_edit($id);
		
		return render("edite_object_content",['realty' => $realty], $realty_types);
		
	}

}











