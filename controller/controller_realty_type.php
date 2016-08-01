<?

error_reporting(E_ALL);

class ControllerRealtyType 
{
	function __call($name,$params)
    {
        e404();
    }
	
	function __construct()
    {
        global $system;

        if ($system->user->role != ModelUser::ROLE_ADMIN)
        {
            header("Location: index.php?controller=controller_auth&redirect=login");
            die();
        }
		
		if(isset($_POST['exit_session']))
		{
			session_unset();
			session_destroy();
			header("Location: index.php");
		}

        //return parent::__construct();
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
			$title = $_POST['title'];
			$realty_type = new RealtyType();
			$realty_type -> load([
								'title' => $title
								]);
			$result = $realty_type->add();
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
			$id = $_GET['id'];
			$title = $_POST['title'];
			$realty_type = new RealtyType($id);
			$realty_type -> title = $title;
			$realty_type -> edit();
			header("Location: index.php?redirect=all_types&controller=controller_realty_type");
			return;
		}	
		
		$id = $_GET['id'];
		$realty_type = new RealtyType();
		$realty_type -> one($id);
		
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
			$id = $_GET['id'];
			
			$realty = Realty::all_by_type($id);
			$types = RealtyType::all_lines();
			$types = RealtyType::type_id_array($types);
			
			if($realty != NULL)
			{	
				$type_not_del = $types[$id]->title;
				return render("existing_type_not_delete_content",['realty' => $realty,
									   'realty_type' => $types,
										'type_not_del' => $type_not_del]);
				
			}
			
			
			$realty_type = new RealtyType();
			$realty_type -> del($id);
			header("Location: index.php?redirect=all_types&controller=controller_realty_type");
			return;
		}
		
		$id = $_GET['id'];
		$realty_type = new RealtyType();
		$realty_type -> one($id);
		
		return render("realty_type_delete_content",['realty_type' => $realty_type]);
		}

	}





