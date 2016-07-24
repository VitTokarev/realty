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
		
		$types = RealtyType::all_lines();
		
		$types = RealtyType::type_id_array($types);		
		
		return render("index_content",['realty' => $realty,
									   'realty_type' => $types
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
		$realty = new Realty($id);		
		
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
			$type_id = $_POST['type_id'];
			$title = $_POST['title'];
			$address = $_POST['address'];
			$price = $_POST['price'];
				
			//Realty::add_line($type, $title, $address, $price);
			
			$realty = new Realty();
                $realty->load([
                    'type_id' => $type_id,
					'title' => $title,
                    'address' => $address,
                    'price' => $price
                ]);

                $result = $realty->add();

                if ($realty) {
                    header("Location: index.php?redirect=one_line&id={$realty->id}");
                    die();
                }
			
			
		}	
		
		
		$realty_types = RealtyType::all_lines();
		
		
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
			//Realty::delete_line($id);
			$realty = new Realty();
			$realty -> del($id);
			
			header("Location: index.php");
			return;
		}	
		
		$id = $_GET['id'];
		//$realty = Realty::one_line($id);
		$realty = new Realty($id);
		
		//return render("one_object_content",['realty' => $realty]);
		
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
			$type_id = $_POST['type_id'];
			$title = $_POST['title'];
			$address = $_POST['address'];
			$price = $_POST['price'];
			
			
			$realty = new Realty($id);
			$realty -> type_id = $type_id;
			$realty -> title = $title;
			$realty -> address = $address;
			$realty -> price = $price;
			$realty -> edit();
			
			header("Location: index.php?redirect=one_line&id={$realty->id}");
			
			return;
		}	
		
		$id = $_GET['id'];
		$realty = new Realty($id);
		$realty_types = RealtyType::realty_types_for_edit($id);
		
		return render("edite_object_content",['realty' => $realty], $realty_types);
		
	}

}











