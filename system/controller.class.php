<?php

Class Controller
{
    protected $layout = 'index.php';

    
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
    
    public function render($view_name, $data = [], $realty_types =[], $with_layout = true)
	{
		ob_start();
		// проверка существования файла
	
		foreach($data as $key => $value)
		{
			$$key = $value;
		}
		
		$realty_types;
		
		require_once("teamplates/$view_name.php");
		$content = ob_get_contents();
		ob_end_clean();
	
		if ($with_layout)
		{
			ob_start();
			require_once("teamplates/layout/index.php");
			$content = ob_get_contents();
			ob_end_clean();
		}
	
		return $content;
	}
	
}	