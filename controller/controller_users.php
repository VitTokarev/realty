<?php


class ControllerUsers
{
    function __call($name, $params)
    {
        e404();
    }

    function users_add_controller()
    {

        if (count($_POST)) {
            if ($_POST['action'] === 'add') {
                $username = $_POST['username'];
                $password = $_POST['password'];
                $role = $_POST['role'];

                $user = new User();
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

        return render('users/add_user', [

        ]);

    }

    function users_list_controller()
    {
        $users = User::all_lines();

        return render('users/user_list', [
            'users' => $users
        ]);
    }
	
	function users_del_controller()
    {
        
				$id = $_GET['id'];
                $user = new User();
                

                

                if ($user->del($id)!==Model::CREATE_FAILED) {
                    header("Location: index.php?redirect=users_list&controller=controller_users");
                    die();

                }
                else
                {
                    die("Не удалось добавить");
                }

            
        

        return render('users/add_user', [

        ]);

	}
	
	function users_edit_controller()
    {
		$id = $_GET['id'];
		
		$user_edit = new User();
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

        return render('users/edit_user', [
					'user_edit' => $user_edit
        ]);

    }
}
















