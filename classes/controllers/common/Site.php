<?php
	class Site{
		function __construct(){
			
		}
		
		
		function wrapContent($response){
			$view = LoadClass(SiteRoot . '/classes/views/common/SiteView');
			
			$response->setContent($view->mainTemplate($response->getContent()));
			
			return $response;
		}
		
		
	}
?>