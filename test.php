<?
	
// $array[0] = array('id' => 1,
				 // 'type' => 'комната',
				 // 'title' => '1-комната',
				 // 'price' => 100);
				 
// $array[1] = array('id' => 2,
				// 'type' => 'квартира',
				// 'title' => '2-х комнатная',
				// 'price' => 200);

// print_r($array);

// echo "<br>";
// $arr = array();
// foreach($array as $row)
        // {
			// print_r($row);
			// echo '<br>';
			// print_r($row);
			// echo '<br>';
            // $arr[$row->id] = $row;
        // }
// echo "<br>";

// print_r($arr);

// echo "<br>";


class Some
{
	public $name;
	
	public function __construct($name)
	{
		$this->name = $name;
	}
	public function view()
	{
		echo "<h1>$this->name</h1>";
		echo '<br>';
	}
	public function __get($name)
	{
		echo 'Сработала функция __get';
		echo '<br>';
	}
	public function __set($name, $value)
	{
		echo 'Сработала функция __set';
		echo '<br>';
	}
	public function __call($name, $params)
	{
		echo 'Сработала функция __call';
		echo '<br>';
		echo '$name ='.$name.'<br>';
		echo '$params ='.$params.'<br>';
	}
}
$some = new Some('aaa');

$some->view();

$some->name = 'bbb';

$some->view();

//echo $some->a; // обращение к свойству, которого нет

//$some->b = 'ccc'; // установка свойства, которого нет

$some->what(); // обращение к методу, которого нет





