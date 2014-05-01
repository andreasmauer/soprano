<?php

	// depending on the value 'templatestyle' we have to call one or another
	// the body should be always created without many exceptions

	class view
	{
		public $content;
		public $content_keys;
		public $path;
		public $frontend_path;
		public $head;
		public $body;
		public $new_inside_each = array();





		public function __construct($content, $_secure_config_obj)

		{

			$this->content = $content;
			$this->path = $_secure_config_obj->path;
			$this->frontend_path = $_secure_config_obj->frontend_path;
			$this->content_keys = array_keys($content);

		}

		private function get_categories()
		{

			
			

					

		}

		public function render_template()
		{

			$this->get_categories();



	

			// the body
			$this->body = file_get_contents($this->path . 'templates/' . $this->content['templatestyle'] . '.php');

			
			// replace the {{each}} moustache

			foreach ($this->content_keys as $key)
			{


				if ((strpos($this->body, '{{#each ' . $key) > -1) AND (gettype($this->content[key] == "array")))
				{
					$inside_each = explode('{{#each ' . $key . '}}', $this->body);
					$inside_each = $inside_each[1];
					$inside_each = explode('{{/each}}', $inside_each);
					$inside_each = $inside_each[0];





					foreach ($this->content[$key] as $element)
					{
						$subkeys = array_keys($element);
						
						// echo "the subkeys : ";
						// print_r ($subkeys);
						$to_print;
						
						$new_inside_each = $inside_each;
						foreach ($subkeys as $subkey)
						{
							if (strpos($new_inside_each, '{{' . $subkey . '}}') > -1)
							{
			
								$new_inside_each = str_replace('{{' . $subkey . '}}', $element[$subkey], $new_inside_each);
							}
							
							
						}

						array_push($this->new_inside_each, $new_inside_each);

					}

					$final_inside_each;
					foreach ($this->new_inside_each as $piece_new_inside_each)
					{
						$final_inside_each = $final_inside_each . $piece_new_inside_each;
					}

					$this->body = str_replace('{{#each ' . $key . '}}' . $inside_each . '{{/each}}', $final_inside_each, $this->body);
					

				}


				
			}



			// the head
			$this->head = file_get_contents($this->path . 'templates/head.php');
			
			// path is the first to replace
			$this->head = str_replace('{{@path}}', $this->frontend_path, $this->head);

			// I replace all the moustache variables
			foreach ($this->content_keys as $key)
			{			
				$this->head = str_replace('{{' . $key . '}}', $this->content[$key], $this->head);
			}



			// the body

			
			// path is the first to replace
			$this->body = str_replace('{{@path}}', $this->frontend_path, $this->body);

			// I replace all the moustache variables
			foreach ($this->content_keys as $key)
			{	
		
				$this->body = str_replace('{{' . $key . '}}', $this->content[$key], $this->body);
			}




			echo $this->head;
			echo $this->body;



		}



	}




?>