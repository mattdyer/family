<?php
	//require_once(SiteRoot . '/classes/common/Record.php');
	class TreeDown{
		function __construct(){
			
		}
		
		
		function prepareResponse($url, $form){
			
			$response = LoadClass(SiteRoot . '/classes/controllers/common/Response');
			
			$view = LoadClass(SiteRoot . '/classes/views/display/TreeView');
			
			if(isset($url['personID'])){
				
				if(isset($url['depth'])){
					$depth = $url['depth'];
				}else{
					$depth = 3;
				}
				
				$treeController = LoadClass(SiteRoot . '/classes/controllers/tree/TreeController');
				
				$tree = $treeController->getTreeDown($url['personID'], 0, $depth);
				
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