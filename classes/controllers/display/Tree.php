<?php
	//require_once(SiteRoot . '/classes/common/Record.php');
	class Tree{
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
		
		
		/*function getTreeUp($personID, $depth, $maxDepth){
			
			$personObj = LoadClass(SiteRoot . '/classes/models/people/Person');
			$personObj->load($personID);
			
			$person = $personObj->getFields();
			
			$tree = [];
			
			array_push($tree, [
				'type' => 'people',
				'people' => [],
				'marriages' => []
			]);
			
			$tree[0] = $this->addPersonToTreeLevel($tree[0], $person);
			
			$tree = $this->addParents($tree, $personID, $depth + 1, $maxDepth);
			
			
			return $tree;
		}
		
		
		function addParents($tree, $personID, $depth, $maxDepth){
			
			
			if($depth <= $maxDepth){
				$personController = LoadClass(SiteRoot . '/classes/controllers/people/PersonController');
				
				$parents = $personController->getParents($personID);
				
				if(sizeof($parents)){
					
					array_push($tree, [
						'type' => 'people',
						'people' => [],
						'marriages' => []
					]);
					
					foreach($parents as $parent){
						$tree[$depth] = $this->addPersonToTreeLevel($tree[$depth], $parent);
						
						$tree = $this->addParents($tree, $parent['id'], $depth + 1, $maxDepth);
					}
					
				}
				
			}
			
			$tree[$depth - 1] = $this->addMarriagesToTreeLevel($tree[$depth - 1]);
			
			
			return $tree;
		}
		
		
		function addPersonToTreeLevel($treeLevel, $person){
			
			$personController = LoadClass(SiteRoot . '/classes/controllers/people/PersonController');
			
			//$marriages = $personController->getMarriages($person['id']);
			$currentLastName = $personController->getCurrentLastName($person['id'], $person['lastName'], time());
			
			array_push($treeLevel['people'], [
				'fields' => $person,
				'currentLastName' => $currentLastName,
				'displayLastName' => $personController->getDisplayLastName($currentLastName, $person['lastName'])
			]);
			
			return $treeLevel;
		}
		
		
		function addMarriagesToTreeLevel($treeLevel){
			
			$marriageController = LoadClass(SiteRoot . '/classes/controllers/people/MarriageController');
			
			$personIDs = array_map(fn($row): int => $row['fields']['id'], $treeLevel['people']);
				
			$marriages = $marriageController->getMarriages($personIDs);
			
			foreach($marriages as $key => $marriage){
				$marriages[$key]['children'] = $marriageController->getChildren($marriage['fields']['id']);
			}
			
			$treeLevel['marriages'] = $marriages;
			
			return $treeLevel;
		}*/
		
		
		
	}
?>