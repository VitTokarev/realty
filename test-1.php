<?



	
		$array = array('id' => array(1, 2, 3),
					   'type' => array('комната', 'квартира','сарай'),
					   'title' => array('2-е комнаты', '2-х комнатная', '3-х этажный' ),
					   'price' => array('100', '200', '300')
		);	   
	
	foreach($array as $k => $v)
	{
		$arr[] = $v[0];
	}
	
	print_r($arr);


