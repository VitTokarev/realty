<?
	
	
	
class Model
{
	const FIELD_NOT_EXIST = "{FIELD_NOT_EXIST}";
    const ID_ACCESS_DENIED = "{ID_ACCESS_DENIED}";
    const OBJECT_NOT_EXIST = "{OBJECT_NOT_EXIST}";
    const UPDATE_FAILED = "{UPDATE_FAILED}";
    const OBJECT_ALREADY_EXIST = "{OBJECT_ALREADY_EXIST}";
    const CREATE_FAILED = "{CREATE_FAILED}";
    const DELETE_FAILED = "{DELETE_FAILED}";

    protected static $errors = array(
        self::FIELD_NOT_EXIST,
        self::ID_ACCESS_DENIED,
        self::OBJECT_NOT_EXIST,
        self::OBJECT_ALREADY_EXIST,
        self::UPDATE_FAILED,
        self::DELETE_FAILED,
        self::CREATE_FAILED
    );

    protected static $fields = array();
    protected static $field_types = array();
    protected static $db = NULL;

    protected $is_loaded_from_db;
    protected $is_changed;

    protected $data = array();
    protected $relations = array();

	public function __construct($id = NULL)
    {
        if (static::$fields === array())
        {
            
			//echo '<br><br>';//
			//echo 'model.class.php: static::$fields = ';//
			//print_r(static::$fields);//
			//echo '<br><br>';//
			
			static::init_fields();
        }

        if ($id !== NULL)
        {
            $id = (int) $id;
            if ($this->one($id))
            {
                $this->is_loaded_from_db = true;
            }
            else
            {
                // сообщить об ошибке
            }
        }
        else
        {
            $this->is_loaded_from_db = false;
        }

        $this->is_changed = false;
	}
	
	    public function __get($field)
    {
        if ((!in_array($field,static::$fields))&&(!in_array($field,$this->get_relation_fields())))
        {
            return self::FIELD_NOT_EXIST;
        }
        else
        {
            if (isset($this->data[$field]))
            {
                return $this->data[$field];
            }
            else
            {
                if (isset($this->relations[$field]))
                {
                    return $this->relations[$field];
                }
                else
                {
                    return NULL;
                }

            }
        }
    }

    public function __set($field, $value)
    {
        if ((!in_array($field,static::$fields))&&(!in_array($field,$this->get_relation_fields())))
        {
            return self::FIELD_NOT_EXIST;
        }
        else
        {
            if ($field === 'id')
            {
                return self::ID_ACCESS_DENIED;
            }
            else
            {
                if (in_array($field,static::$fields))
                {

                    $this->data[$field] = $value;

                    if ($this->is_loaded_from_db)
                    {
                        $this->is_changed = true;
                    }

                    return $this->data[$field];


                }
                else
                {
                    return self::FIELD_NOT_EXIST;
                }
            }
        }
    }
	
	public static function tableName()
    {
        return NULL;
    }

    public static function className()
    {
        return 'Model';
    }
	
	protected static function get_db()
    {
        if (self::$db === NULL)
        {
            include("model/db.php");
            self::$db = $link;
        }
        return self::$db;
    }
	
	protected static function get_fields()
    {
        if (static::$fields === array())
        {
            static::init_fields();
        }
        return static::$fields;
    }
	
	 protected static function fields_query()
    {
        $fields = static::get_fields();

        $result = '';
        foreach($fields as $f)
        {
            if ($result !== '') $result .= ', ';

            $result .= "`{$f}`";
        }

        return $result;
    }

    protected function values_query()
    {
        $fields = static::get_fields();

        $result = '';
        foreach($fields as $f)
        {
            if ($result !== '') $result .= ', ';

            if ((isset($this->data[$f]))&&($this->data[$f]!==NULL))
            {
                $result .= "'{$this->data[$f]}'";
            }
            else
            {
                $result .= "NULL";
            }
        }

        return $result;
    }

    protected function update_query($updated_fields = array())
    {
        $fields = array();

        if ($updated_fields === array())
        {
            $fields = static::get_fields();
        }
        else
        {
            foreach($updated_fields as $uf)
            {
                if (in_array($uf,static::get_fields()))
                {
                    $fields[] = $uf;
                }
            }
        }

        $result = '';
        foreach($fields as $f)
        {
            if ($result !== '') $result .= ', ';

            if ((isset($this->data[$f]))&&($this->data[$f]!==NULL))
            {
                $result .= "`{$f}` = '{$this->data[$f]}'";
            }
            else
            {
                $result .= "`{$f}` = NULL";
            }

        }
        return $result;
    }
	
	protected function get_relation_fields()
    {
        return array_keys($this->relations);
    }

	
	public static function all_lines()
	{	
		
		$sql = "SELECT * FROM `".static::tableName()."` WHERE 1"; //OK
		
		//echo '<br><br>';
		//echo 'model.class.php: static::tableName() = '.static::tableName();//
		//echo '<br><br>';
		
		$res = mysqli_query(self::get_db(), $sql) or die(mysqli_error(self::get_db()));
		$realty = array();
		
		//echo '<br><br>';
		//echo 'model.class.php: static::className() = '.static::className();
		//echo '<br><br>';
			 
		
		while ($row = mysqli_fetch_assoc($res))
		{
			//echo 'model.class.php: function all_lines(): $row = ';//OK
			//print_r($row);//
			//echo '<br><br>';//
			
			$class_name = static::className(); //Realty 
			 
            $one = new $class_name();
			
			//echo 'model.class.php: function all_lines(): $one = ';//OK
			//echo $class_name;//
			//echo '<br><br>';//
			
            /* @var $one Model */
            if ($one->load($row))
            {
                $all[] = $one;
				
				echo 'model.class.php: function all_lines(): $all[] = ';//ERR
				print_r($all);//
				echo '<br><br>';//
            }
        }
		//echo "static::tableName() =".static::tableName()."<br>";//
		//echo "static::className() =".static::className()."<br>";//
		//echo 'model.class.php: function all_lines(): $all = ';//
		//print_r($all)."<br>";//
        return $all;
	}
	
	public function load_relations($data = array())
    {
        foreach($data as $k => $v)
        {

            $this->relations[$k] = $v;

        }
        return true;
    }
	
	public function load($data = array())
    {
        foreach($data as $k => $v)
        {
			
            if (!in_array($k, static::$fields))
            {
                return self::FIELD_NOT_EXIST;
            }
            else
            {
		
				//echo '<br><br>model.class.php class Model, public function load($data = array()), static::$fields = ';
				//print_r(static::$fields);
				//echo '<br><br>';
		
                $this->data[$k] = $v;
				
				echo '<br><br>model.class.php class Model, public function load($data = array()), $k = ';
				print_r($k);
				echo '<br><br>';
				
				echo '<br><br>model.class.php class Model, public function load($data = array()), $v = ';
				print_r($v);
				echo '<br><br>';
				
				
				echo '<br><br>model.class.php class Model, public function load($data = array()), data['.$k.'] = ';
				print_r($this->data);
				echo '<br><br>';
            }
        }
        return true;
    }
	
	protected static function init_fields()
    {
        $query = "DESCRIBE `".static::tableName()."`;";
        $result = mysqli_query(self::get_db(),$query);
        while($row = mysqli_fetch_assoc($result))
        {
            static::$fields[] = $row['Field'];

            if (strpos($row['Type'],'('))
            {
                $pie = explode('(',$row['Type'],2);
                $row['Type'] = $pie[0];
            }

            static::$field_types[$row['Field']] = $row['Type'];

        }
    }
	
	 

	
	
	
	
	
}
	
	
	
	
	
	
	
	
	
	