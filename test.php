<?
	
$array[0] = array('id' => 1,
				 'type' => 'комната',
				 'title' => '1-комната',
				 'price' => 100);
				 
$array[1] = array('id' => 2,
				'type' => 'квартира',
				'title' => '2-х комнатная',
				'price' => 200);

print_r($array);

echo "<br>";
$arr = array();
foreach($array as $row)
        {
			print_r($row);
			echo '<br>';
			print_r($row->id);
			echo '<br>';
            $arr[$row->id] = $row;
        }
echo "<br>";

print_r($arr);

echo "<br>";


