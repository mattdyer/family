<?php
	
	namespace classes\controllers\display;

	use classes\controllers\common\Response;
	use classes\views\display\TreeView;
	use classes\controllers\tree\TreeController;

	class Tree{
		function __construct(){
			
		}
		
		
		function prepareResponse($url, $form){
			
			$response = new Response();
			
			$view = new TreeView();
			
			if(isset($url['personID'])){
				
				if(isset($url['depth'])){
					$depth = $url['depth'];
				}else{
					$depth = 3;
				}
				
				$treeController = new TreeController();
				
				$tree = $treeController->getTreeUp($url['personID'], 0, $depth);
				
				$tree = array_reverse($tree);
				
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