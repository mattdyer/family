<?php
	
	namespace classes\controllers\display;

	use classes\controllers\common\Response;
	use classes\views\display\ListView;
	
	class ListController{
		function __construct(){
			
		}
		
		
		function prepareResponse($url, $form){
			
			$response = new Response();
			
			$view = new ListView();
			
			$content = $view->getDefaultPageContent();
				
			$response->setContent($content);
			
			return $response;
		}
		
		
	}
?>