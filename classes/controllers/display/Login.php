<?php
	
	namespace classes\controllers\display;

	use classes\controllers\common\Response;
    use classes\views\display\LoginView;

	class Login{
		function __construct(){
			
		}
		
		
		function prepareResponse($url, $form){
			
			$response = new Response();
			
			$view = new LoginView();
			
			$content = $view->getDefaultPageContent();
				
			$response->setContent($content);
			
			return $response;
		}
		
		
	}
?>