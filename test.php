<?
	

	

	
$array = array(array("one", "two"),
			   array("three", "for", "five"),
			   array("six", "seven", "eight"),
			   array("nine", "ten", "eleven")
			   
);

print_r($array);

echo "<br>";


	foreach($array as $k => $v)
	{
		$array[$k] = $v;
		
	}

print_r($array);

$row = 
	['type' => 'room',
	 'type_id' => 1
	
	];
echo "<br>";


print_r($row);
