<?php


class ControllerUsers extends Controller
{
    function __call($name, $params)
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

    function users_add_controller()
    {

        if (count($_POST)) {
            if ($_POST['action'] === 'add') {
                $username = $_POST['username'];
                $password = $_POST['password'];
                $role = $_POST['role'];

                $user = new ModelUser();
                $user->username = $username;
                $user->role = $role;
                $user->create_password($password);

                // TODO обработать password

                if ($user->add()!==Model::CREATE_FAILED) {
                    header("Location: index.php?redirect=users_list&controller=controller_users");
                    die();

                }
                else
                {
                    die("Не удалось добавить");
                }

            }
        }

        return $this->render('users/add_user', [

        ]);

    }

    function users_list_controller()
    {
        $users = ModelUser::all_lines();

        return $this->render('users/user_list', [
            'users' => $users
        ]);
    }
	
	function users_del_controller()
    {
        
				$id = $_GET['id'];
                $user = new ModelUser();
                

                

                if ($user->del($id)!==Model::CREATE_FAILED) {
                    header("Location: index.php?redirect=users_list&controller=controller_users");
                    die();

                }
                else
                {
                    die("Не удалось добавить");
                }

            
        

        return $this->render('users/add_user', [

        ]);

	}
	
	function users_edit_controller()
    {
		$id = $_GET['id'];
		
		$user_edit = new ModelUser();
		$user_edit -> one($id); 

        if (count($_POST)) {
            if ($_POST['action'] === 'edit') {
                $username = $_POST['username'];
                $password = $_POST['password'];
                $role = $_POST['role'];
				

                
				$user_edit->id = $id;
                $user_edit->username = $username;
                $user_edit->role = $role;
                $user_edit->create_password($password);

                // TODO обработать password

                if ($user_edit->edit()!==Model::CREATE_FAILED) 
				{
                    header("Location: index.php?redirect=users_list&controller=controller_users");
                    die();

                }
                else
                {
                    die("Не удалось добавить");
                }

            }
        }

        return $this->render('users/edit_user', [
					'user_edit' => $user_edit
        ]);

    }
}
















