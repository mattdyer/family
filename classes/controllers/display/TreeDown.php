<?php
	//require_once(SiteRoot . '/classes/common/Record.php');
	class TreeDown{
		function __construct(){
			
		}
		
		
		function prepareResponse($url, $form){
			
			$response = LoadClass(SiteRoot . '/classes/controllers/common/Response');
			
			$view = LoadClass(SiteRoot . '/classes/views/display/TreeView');
			
			if(isset($url['personID'])){
				
				$treeController = LoadClass(SiteRoot . '/classes/controllers/tree/TreeController');
				
				$tree = $treeController->getTreeDown($url['personID'], 0, 3);
				
				//$tree = array_reverse($tree);
				
				$content = $view->getTreeContent($tree);
				
				$response->setContent($content);
				
				
			}else{
				$content = $view->getDefaultPageContent();
				
				$response->setContent($content);
			}
			
			return $response;
		}
		
		
	}
?>