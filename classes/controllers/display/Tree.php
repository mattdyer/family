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
			
			$personController = LoadClass(SiteRoot . '/classes/controllers/people/PersonController');
			
			$person = $personObj->getFields();
			
			$tree = [[$person]];
			
			array_push($tree, addParents($person, $depth));
			
			//$parents = $personController->getParents($personObj);
			//$children = $personController->getChildren($personObj);
			//$siblings = $personController->getSiblings($personObj);
			
			
			//$tree = $children;
			
			return $tree;
		}
		
		
		function addParents($person, $depth){
			$parents = $personController->getParents($personObj);
			
			if(sizeof($parents)){
				foreach()
			}
			
		}
		
		
	}
?>