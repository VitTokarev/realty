<?php

class ControllerAuth extends Controller
{
    function __call($name, $params)
    {
        e404();
    }

    function login_controller()
    {

        if (count($_POST)) {
            if ($_POST['action'] === 'login') {
                $username = $_POST['username'];
                $password = $_POST['password'];

                $user = new ModelUser();

                if ($user->auth($username,$password)) {
                    header("Location: index.php");
                    die();

                }
                else
                {
                    header("Location: index.php?cat=auth&view=login");
                    die();
                }

            }
        }

        return $this->render('auth/login', [

        ]);

    }


}