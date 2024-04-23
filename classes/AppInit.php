<?php 
	
	function customErrorHandler($errno, $errstr, $errfile, $errline, $errcontext){
		if($errno <= 128){
			ob_start();
			
					echo "Error Number: " . $errno . "\n\n";
					echo "Error String: " . $errstr . "\n\n";
					echo "Error File: " . $errfile . "\n\n";
					echo "Error Line: " . $errline . "\n\n";
					var_dump($errcontext['_POST']);
					var_dump($errcontext['_GET']);
					var_dump($errcontext['_SERVER']);
					var_dump($errcontext['_SESSION']);
					foreach($errcontext as $key => $value){
						if(is_string($value)|is_numeric($value)){
							echo '[' . $key . ': ' . $value . ']';
						}
					}
					
					print_r(debug_backtrace());
					
					$ErrorContent = ob_get_contents();
			ob_end_clean();
			
			print('<pre>');
			print_r($ErrorContent);
			print('</pre>');
			
			
			
			die('Error Occured');
			
			/*
			mail('matt@mandjscreations.com',$errstr,$ErrorContent,'From: matt@mandjscreations.com');
			if($errno <= 8){
				mail('madmatt1220@gmail.com',$errstr,$ErrorContent,'From: matt@mandjscreations.com');
			}
			//header('HTTP/1.1 500 Internal Server Error');
			die('Error Occured');
			*/
		}
		return false;
	}
	
	set_error_handler("customErrorHandler");
	
	define('SiteRoot', $_SERVER['DOCUMENT_ROOT']);
	
	function IncludeClass($ClassPath){
		require_once($ClassPath . '.php');
		return true;
	}

	function LoadClass($ClassPath){
		require_once($ClassPath . '.php');
		$ClassName = basename($ClassPath);
		return new $ClassName;
	}

	require_once(SiteRoot . '/vendor/autoload.php');
	
?>