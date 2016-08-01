<?

error_reporting(E_ALL);

class ControllerRealty extends Controller
{
	function __call($name,$params)
    {
        e404();
    }

	
	function __construct()
    {
        global $system;

        if ($system->user->role != ModelUser::ROLE_USER && $system->user->role != ModelUser::ROLE_ADMIN)
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
//Выборка всех объектов
	
	public function all_lines_controller()
	{
		$realty = ModelRealty::all_lines(); 
		
		$types = ModelRealtyType::all_lines();
		
		$types = ModelRealtyType::type_id_array($types);		
		
		return $this->render("index_content",['realty' => $realty,
									   'realty_type' => $types
		]);
	}
	
	
	//Выборка одного объекта
	
	public function one_line_controller()
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
		$realty = new ModelRealty($id);		
		
		return $this->render("one_object_content",['realty' => $realty]);
	
	}
	
	// Добавление одного объекта
	
	public function add_line_controller()
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
			
			$realty = new ModelRealty();
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
		
		
		$realty_types = ModelRealtyType::all_lines();
		
		
		return $this->render("add_content",['realty_types' => $realty_types]);
	
	}
	
	//Удаление одного объекта
	
	public function delete_line_controller()
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
			$realty = new ModelRealty();
			$realty -> del($id);
			
			header("Location: index.php");
			return;
		}	
		
		$id = $_GET['id'];
		//$realty = Realty::one_line($id);
		$realty = new ModelRealty($id);
		
		//return render("one_object_content",['realty' => $realty]);
		
		return $this->render("delete_content",['realty' => $realty]);
	}
	
	//Редактирование объекта
	
	public function edit_line_controller()
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
			
			
			$realty = new ModelRealty($id);
			$realty -> type_id = $type_id;
			$realty -> title = $title;
			$realty -> address = $address;
			$realty -> price = $price;
			$realty -> edit();
			
			header("Location: index.php?redirect=one_line&id={$realty->id}");
			
			return;
		}	
		
		$id = $_GET['id'];
		$realty = new ModelRealty($id);
		$realty_types = ModelRealtyType::realty_types_for_edit($id);
		
		return $this->render("edite_object_content",['realty' => $realty], $realty_types);
		
	}

}











