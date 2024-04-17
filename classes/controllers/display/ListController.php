<?php
	class ListController{
		function __construct(){
			
		}
		
		
		function prepareResponse($url, $form){
			
			$response = LoadClass(SiteRoot . '/classes/controllers/common/Response');
			
			$view = LoadClass(SiteRoot . '/classes/views/display/ListView');
			
			$content = $view->getDefaultPageContent();
				
			$response->setContent($content);
			
			return $response;
		}
		
		
	}
?>