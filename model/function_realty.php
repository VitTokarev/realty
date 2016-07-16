<?
error_reporting(E_ALL);
//Выборка всех записей

class Realty extends Model
{
	
	
	public static function className()
    {
        return 'Realty';
    }

    public static function tableName()
    {
        return 'realty';
    }
	
	
	
	function __construct($id = NULL)
    {
        if ($id !== NULL)
        {
            $this->id = $id;
            $this->init();
        }
    }
    
	 public static function all_lines()
	{	
		$realty = parent::all_lines(); //model.class.php
		
		//echo '<br><br>function_realty.php parent::all_lines() =';//ERR
		//print_r($realty);//
		//echo '<br><br>';//
		
		$types = RealtyType::all_lines(); //function_realty_type.php
		$types = ArrayHelper::index($types,'type_id');
		
		foreach (array_keys($realty) as $k)
        {
			//echo '<br><br>function_realty.php array_keys($realty) =';
			//print_r(array_keys($realty));//
			//echo '<br><br>';//
            $realty[$k]->load_relations(
                [
                    'type' => $types[$realty[$k]->type_id]
                    
                ]
            );
        }
		
		return $realty;
	}
	

	public function load($data = array(),$with_relations = false)
		{
			$result = parent::load($data);
	
			if ($with_relations)
			{
		
				//echo '<br><br>';
				//echo 'function_realty.php: public function load($data = array(),$with_relations = false) = ';
				//echo $with_relations;
				//echo '<br><br>';
		
				if ($this->type_id !== NULL) {
					$this->relations['type'] = new RealtyType($this->type_id);
				}				
			}
			return $result;
		}
	
	
	// public $id;
	// public $type;
    // public $type_id;
    // public $title;
    // public $address;
    // public $price;
	
	//Выборка одной записи
	
	// public static function one_line($id)
	// {
		// global $link;
		// $sql = "SELECT `realty`.`id` ,`realty_type`.`type`, `realty`.`title`, `realty`.`address`, `realty`.`price` FROM `realty` LEFT JOIN `realty_type` ON realty.type_id = realty_type.type_id WHERE `realty`.`id` = '".$id."'";
		// $res = mysqli_query($link, $sql) or die(mysqli_error($link));
		// $realty = array();
		// $realty = mysqli_fetch_assoc($res);
		
		// return $realty;
	// }
	
	//Добавление одной записи
	
	// public static function add_line($type, $title, $address, $price)
	// {	
		// global $link;
		// $sql = "INSERT INTO `realty` (`id`,`type_id`, `title`, `address`, `price`) VALUES (NULL, '".$type."', '".$title."', '".$address."', '".$price."')";            
		// mysqli_query($link, $sql) or die(mysqli_error($link));
	
		// return true;
	// }
	
	//Удаление записи
	
	// public static function delete_line($id)
	// {
		// global $link;
		// $sql ="DELETE FROM `realty` WHERE `realty`.`id` = '".$id."'";
		// $res = mysqli_query($link, $sql) or die(mysqli_error($link));
		
		// return true;
	// }
	
	//Редактирование записи
	
	// public static function edite_line($id, $type, $title, $address, $price)
	// {
		// global $link;
		// $sql = "UPDATE `realty` SET `type_id` = '".$type."', `title` = '".$title."', `address` = '".$address."', `price` = '".$price."' WHERE `realty`.`id` = '".$id."'";
		// $res = mysqli_query($link, $sql) or die(mysqli_error($link));
		
		// return true;
	// }
}
