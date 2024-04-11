<?php
	//require_once(SiteRoot . '/classes/common/Record.php');
	class Tree{
		function __construct(){
			
		}
		
		
		function prepareResponse($url, $form){
			
			$response = LoadClass(SiteRoot . '/classes/controllers/common/Response');
			
			$view = LoadClass(SiteRoot . '/classes/views/display/TreeView');
			
			if(isset($url['personID'])){
				
				$tree = $this->getTree($url['personID'], 3);
				
				
				$content = $view->getTreeContent($tree);
				
				$response->setContent($content);
				
				
			}else{
				$content = $view->getDefaultPageContent();
				
				$response->setContent($content);
			}
			
			return $response;
		}
		
		
		function getTree($personID, $depth){
			
			$personObj = LoadClass(SiteRoot . '/classes/models/people/Person');
			$personObj->load($personID);
			
			$person = $personObj->getFields();
			
			$tree = [[$person]];
			
			array_push($tree, $this->addParents($personObj, $depth));
			
			//$parents = $personController->getParents($personID);
			//$children = $personController->getChildren($personID);
			//$siblings = $personController->getSiblings($personID);
			
			
			//$tree = $children;
			
			return $tree;
		}
		
		
		function addParents($personObj, $depth){
			
			$personController = LoadClass(SiteRoot . '/classes/controllers/people/PersonController');
			
			$parents = $personController->getParents($personObj->get('id'));
			
			
			return $parents;
		}
		
		
	}
?>