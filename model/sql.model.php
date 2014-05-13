<?php
// I decided that the sql queries should be on the model
// there are a lot of discussion about mvc and databases, some say it should be out of the model, some say it should be in
// I consider that for a clear work I keep the retrieve and work of data always on the model



	class sql_driver
	{
		// at the beginning it would be just a class to pull data, but I can expand it to push as well
		// sql_driver is maybe a good object name, that define what this class is reponsible for


		// the external objects that I have to use
		public $_database_obj;
		public $_config_obj;
		public $_router_obj;

		public $column_headers = array();
		public $sql_everything_from_uri = array();


		public function __construct($_database_obj, $_config_obj, $_router_obj)
		{
			$this->_database_obj = $_database_obj;
			$this->_config_obj = $_config_obj;
			$this->_router_obj = $_router_obj;

			$this->_database_obj->mysqli->select_db($this->_database_obj->dbname);
			
		}

		public function get_sql_headers()
		{


			$query = "SHOW COLUMNS FROM " . $this->_database_obj->table;
			$nameofcolumns = $this->_database_obj->mysqli->query($query) or trigger_error($this->_database_obj->mysqli->error);

			while ($row = $nameofcolumns->fetch_array(MYSQLI_ASSOC))


			{
				array_push($this->column_headers, $row['Field']);
			}
	

		}



		public function get_everything_from_uri()
		{
			
			// I need to get the headers first
			$this->get_sql_headers($this->_database_obj);


			// this way is dangerouse and doesnt prevent injection
			// it should be replaced for the version in testing that is coded and commented under it
			
			$query = "SELECT * FROM " . $this->_database_obj->table . " WHERE host='" . $this->_router_obj->http_host . "'" . "AND uri='" . $this->_router_obj->uri . "'";
			$result = $this->_database_obj->mysqli->query($query) or trigger_error($this->_database_obj->mysqli->error);

			// I pass all the values from the database to the array
			$row = $result->fetch_array(MYSQLI_ASSOC);
			foreach ($this->column_headers as $key)
			{
				$this->sql_everything_from_uri[$key] = $row[$key];
			}

			

			// //    ------testing mysqli prevention of injection
			// // this testing could be use with the new Mysql Native Driver
			// // the native driver come with php 5.4
			// // CentOs is on 5.3.3 and I dont feel like upgrading it

			// $query = "SELECT * FROM " . $this->_database_obj->table . " WHERE host='" . $this->_router_obj->http_host . "'" . "AND uri=?";
			// $stmt = $this->_database_obj->mysqli->prepare("SELECT * FROM " . $this->_database_obj->table . " WHERE host='" . $this->_router_obj->http_host . "'" . "AND uri=?");
			// $stmt->bind_param('s', $uri);
			// $stmt->execute();
			// $result = $stmt->get_result();

			// $row = $result->fetch_array(MYSQLI_ASSOC);
			// foreach ($this->column_headers as $key)
			// {
			// 	$this->sql_everything_from_uri[$key] = $row[$key];
			// }

			// // --------end of testing


			
			// now I have to extract the keys that has an array-way string inside and convert them on array

			foreach ($this->column_headers as $header)
			{
				
				if (strpos($this->sql_everything_from_uri[$header], "id: ") > -1)
				{
					
					$final_array[$header] = array();
					$array_way_string = $this->sql_everything_from_uri[$header];
					$units = explode("; ", $array_way_string);
					
					foreach ($units as $unit)
					{
						$unit_to_push = array();
						
						$pairs = explode(", ", $unit);
						

						foreach ($pairs as $pair)
						{
						
							$key0value1 = explode(": ", $pair);
							$unit_to_push[$key0value1[0]] = $key0value1[1];

						}

						array_push($final_array[$header], $unit_to_push);
					}
					
					// Now I replace the sql_everything_from_uri
					// in case there is any array that should be introduced as array, I remove the string
					// and introduce the array


					foreach ($this->column_headers as $header)
					{
						if ($final_array[$header])
						{
							$this->sql_everything_from_uri[$header] = $final_array[$header];
						}

					}


				}


			}
			//print_r ($this->sql_everything_from_uri);
			return ($this->sql_everything_from_uri);

		}





	}

?>