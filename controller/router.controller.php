<?php

// on .htaccess every uri with .php will be translated to pag=
// the server request_uri work later, over the "translated" uri 
// the get work before, and can pull the parameters

	class router 
	{
		public $http_host;
		public $uri;
		public $pag_parameter;

		public function __construct ()
		{
			$this->http_host = $_SERVER['HTTP_HOST'];
			$this->uri = $_SERVER['REQUEST_URI'];
			$this->pag_parameter = $_GET['pag'];
			
			echo "environment variables : <br>";
			echo "host: " . $this->http_host . "<br>";
			echo "uri: " . $this->uri . "<br>";
			echo "parameter_pag: " . $this->pag_parameter . "<br>";


		}


	}

?>