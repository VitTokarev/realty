<?

error_reporting(E_ALL);

class ControllerRealtyType extends Controller 
{
	function __call($name,$params)
    {
        e404();
    }
	
	

//Выборка всех типов

	public function all_types_controller()
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
		
		$realty_types = ModelRealtyType::all_lines();
	
		return $this->render("main_type_content",['realty_types' => $realty_types]);
	}
	
	//Добавление типа
	
	public function add_type_controller()
	{
		if(ISSET($_POST['esc_submit']))
		{	
			header("Location: index.php?redirect=all_types&controller=controller_realty_type");
			return;
		}	
		
		if(ISSET($_POST['add_type']))
		{	
			$title = $_POST['title'];
			$realty_type = new ModelRealtyType();
			$realty_type -> load([
								'title' => $title
								]);
			$result = $realty_type->add();
			header("Location: index.php?redirect=all_types&controller=controller_realty_type");
			return;
		}	
		
		return $this->render("add_type_content");
	}
	
	
	//Редактирование типа
	
	public function edite_type_controller()
	{
		if(ISSET($_POST['esc_submit']))
		{	
			header("Location: index.php?redirect=all_types&controller=controller_realty_type");
			return;
		}	
		
		if(ISSET($_POST['edite_type']))
		{	
			$id = $_GET['id'];
			$title = $_POST['title'];
			$realty_type = new ModelRealtyType($id);
			$realty_type -> title = $title;
			$realty_type -> edit();
			header("Location: index.php?redirect=all_types&controller=controller_realty_type");
			return;
		}	
		
		$id = $_GET['id'];
		$realty_type = new ModelRealtyType();
		$realty_type -> one($id);
		
		return $this->render("realty_types_edite_content",['realty_type' => $realty_type]);
	}
	
	//Удаление типа
	
	public function delete_type_controller()
	{
	
		if(ISSET($_POST['esc_submit']))
		{	
			header("Location: index.php?redirect=all_types&controller=controller_realty_type");
			return;
		}	
		
		if(ISSET($_POST['delete_type']))
		{	
			$id = $_GET['id'];
			
			$realty = ModelRealty::all_by_type($id);
			$types = ModelRealtyType::all_lines();
			$types = ModelRealtyType::type_id_array($types);
			
			if($realty != NULL)
			{	
				$type_not_del = $types[$id]->title;
				return $this->render("existing_type_not_delete_content",['realty' => $realty,
									   'realty_type' => $types,
										'type_not_del' => $type_not_del]);
				
			}
			
			
			$realty_type = new ModelRealtyType();
			$realty_type -> del($id);
			header("Location: index.php?redirect=all_types&controller=controller_realty_type");
			return;
		}
		
		$id = $_GET['id'];
		$realty_type = new ModelRealtyType();
		$realty_type -> one($id);
		
		return $this->render("realty_type_delete_content",['realty_type' => $realty_type]);
		}

	}





