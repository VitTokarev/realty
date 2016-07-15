<?


	function all()
    {
        $result = all_all();

        $types = ApartmentType::all();
        $types = ArrayHelper::index($types,'id');        



        foreach (array_keys($result) as $k)
        {
            $result[$k]->load_relations(
                [
                    'type' => $types[$result[$k]->type_id],                    
                ]
            );
        }

        return $result;
    }
	
	
	function load_relations($data = array())
    {
        foreach($data as $k => $v)
        {

            $this->relations[$k] = $v;

        }
        return true;
    }
	
	function all_all()
    {
        $query = "SELECT * FROM `apartment` WHERE 1";
        $result = mysqli_query(get_db(),$query);

        $all = array();
        while ($row = mysqli_fetch_assoc($result))
        {
            $class_name = static::className();
            $one = new $class_name();
            /* @var $one Model */
            if ($one->load($row))
            {
                $all[] = $one;
            }
        }

        return $all;
    }
	
	print_r(all());
	
	function get_db()
    {
        if ($db === NULL)
        {
            include("model/db.php");
            $db = $link;
        }
        return $db;
    }
	
	
	