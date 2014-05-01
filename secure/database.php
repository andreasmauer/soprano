<?php	
	class database
	{
		
		public $mysqli;
		public $hostname;
		public $username;
		public $password;
		public $dbname;
		public $table;

		public function __construct($_config_obj) 
		{

			$this->hostname = $_config_obj->config_hostname;
			$this->username = $_config_obj->config_username;
			$this->password = $_config_obj->config_password;
			$this->dbname = $_config_obj->config_dbname;
			$this->table = $_config_obj->config_table;

			$this->mysqli = new mysqli($this->hostname, $this->username, $this->password) OR DIE ('Unable to connect to database! Please try again later.');
			$this->mysqli->set_charset("utf8");  // on ec2 the charset was latin
			//$this->mysqli->select_db($this->dbname); //this should be out of here on the model

		}
	}

?>