<?php
	spl_autoload_register(function ($class_name) {
		
		$classPath = str_replace('\\', '/', $class_name);
		$filePath = SiteRoot . '/' . $classPath . '.php';

		//echo($class_name . '<br>');


		if(file_exists($filePath)){
			include $filePath;
			return;
		}

		/*$filePath = SiteRoot . '/classes/models/people/' . $class_name . '.php';
		
		if(file_exists($filePath)){
			include $filePath;
			return;
		}

		$filePath = SiteRoot . '/classes/controllers/people/' . $class_name . '.php';
		
		if(file_exists($filePath)){
			include $filePath;
			return;
		}

		$filePath = SiteRoot . '/classes/controllers/common/' . $class_name . '.php';
		
		if(file_exists($filePath)){
			include $filePath;
			return;
		}*/

	});
?>