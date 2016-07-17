<?
	

	

	
$array = array('id' => array(1, 2, 3),
			   'type' => array('комната', 'квартира','сарай'),
			   'title' => array('2-е комнаты', '2-х комнатная', '3-х этажный' ),
			   'price' => array('100', '200', '300')
			   
);

print_r($array);

echo "<br>";


	foreach($array as $k => $v)
	{
		echo '<br>$k = '.$k.'<br>';
		echo '<br>$v = '.$v.'<br>';
		$arr[$k] = $v;
		
	}

print_r($arr);

echo "<br>";



$row = 
	['type' => 'room',
	 'type_id' => 1
	
	];
echo "<br>";


print_r($row);

