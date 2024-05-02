<?php
	
	use classes\controllers\common\Response;
	use classes\views\display\TreeView;

	class TreeDown{
		function __construct(){
			
		}
		
		
		function prepareResponse($url, $form){
			
			//$response = LoadClass(SiteRoot . '/classes/controllers/common/Response');
			$response = new Response();
			
			$view = new TreeView();
			
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