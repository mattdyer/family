<?php
	//require_once(SiteRoot . '/classes/common/Record.php');
	class Tree{
		function __construct(){
			
		}
		
		
		function prepareResponse($url, $form){
			
			$response = LoadClass(SiteRoot . '/classes/controllers/common/Response');
			
			$view = LoadClass(SiteRoot . '/classes/views/display/TreeView');
			
			if(isset($url['personID'])){
				
				$tree = $this->getTree($url['personID'], 0, 3);
				
				$tree = array_reverse($tree);
				
				$content = $view->getTreeContent($tree);
				
				$response->setContent($content);
				
				
			}else{
				$content = $view->getDefaultPageContent();
				
				$response->setContent($content);
			}
			
			return $response;
		}
		
		
		function getTree($personID, $depth, $maxDepth){
			
			$personObj = LoadClass(SiteRoot . '/classes/models/people/Person');
			$personObj->load($personID);
			
			$person = $personObj->getFields();
			
			$tree = [];
			
			array_push($tree, []);
			
			$tree[0] = $this->addPersonToTreeLevel($tree[0], $person);
			
			/*array_push($tree[0],[
				'fields' => $person
			]);*/
			
			$tree = $this->addParents($tree, $personID, $depth + 1);
			
			
			return $tree;
		}
		
		
		function addParents($tree, $personID, $depth){
			
			$personController = LoadClass(SiteRoot . '/classes/controllers/people/PersonController');
			
			$parents = $personController->getParents($personID);
			
			
			if(sizeof($parents)){
				
				array_push($tree, []);
				
				foreach($parents as $parent){
					$tree[$depth] = $this->addPersonToTreeLevel($tree[$depth], $parent);
					/*array_push($tree[$depth], [
						'fields' => $parent
					]);*/
					
					$tree = $this->addParents($tree, $parent['id'], $depth + 1);
				}
			}
			
			
			return $tree;
		}
		
		
		function addPersonToTreeLevel($treeLevel, $person){
			
			$personController = LoadClass(SiteRoot . '/classes/controllers/people/PersonController');
			
			//$marriages = $personController->getMarriages($person['id']);
			$currentLastName = $personController->getCurrentLastName($person['id'], $person['lastName'], time());
			
			array_push($treeLevel, [
				'fields' => $person,
				'currentLastName' => $currentLastName,
				'displayLastName' => $personController->getDisplayLastName($currentLastName, $person['lastName']),
				'marriages' => $personController->getMarriages($person['id'])
			]);
			
			return $treeLevel;
		}
		
		
		
	}
?>