<?php


class ControllerUsersOrdinary 
{
    function __call($name, $params)
    {
        e404();
    }

	function users_ordinary_add_controller()
    {

        if (count($_POST)) {
            if ($_POST['action'] === 'add') {
                $username = $_POST['username'];
                $password = $_POST['password'];
                $role = 1;

                $user = new User();
                $user->username = $username;
                $user->role = $role;
                $user->create_password($password);

                // TODO обработать password

                if ($user->add()!==Model::CREATE_FAILED) 
				{
					$user->auth($username,$password);
                    header("Location: index.php");
                    die();

                }
                else
                {
                    die("Не удалось добавить");
                }

            }
        }

        return render('users/add_user_ordinary', [

        ]);

    }

 
}
















