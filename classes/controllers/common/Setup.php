<?php
	//require_once(SiteRoot . '/classes/common/Record.php');
	class Setup{
		function __construct(){
			
		}
		
		function prepareResponse($url, $form){
			
			$response = LoadClass(SiteRoot . '/classes/controllers/common/Response');
			
			$response->setContent('test');
			
			return $response;
		}
		
	}
?>