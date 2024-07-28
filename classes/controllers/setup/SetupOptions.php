<?php
	
	namespace classes\controllers\setup;

	use classes\controllers\common\Response;
	use classes\views\setup\SetupOptionsView;

	class SetupOptions{
		function __construct(){
			
		}
		
		
		function prepareResponse($url, $form){
			
            $response = new Response();

			$view = new SetupOptionsView();
			
			$content = $view->getPageContent();
			
			$response->setContent($content);
			
			return $response;
		}
		
		
		
	}
?>