<?php

class ControllerAuth
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

                $user = new User();

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

        return render('auth/login', [

        ]);

    }


}