<?php
	class TreeController{
		function __construct(){
			
		}
		
		function getTreeUp($personID, $depth, $maxDepth){
			
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
			
			/*array_push($tree[0],[
				'fields' => $person
			]);*/
			
			$tree = $this->addParents($tree, $personID, $depth + 1, $maxDepth);
			
			
			return $tree;
		}
		
		
		function getTreeDown($personID, $depth, $maxDepth){
			
			$personObj = LoadClass(SiteRoot . '/classes/models/people/Person');
			$personObj->load($personID);
			
			$tree = [];
			
			$tree = $this->addNextTreeDownRow($tree, $personObj->getFields(), $depth, $maxDepth);
			
			/*$tree[0] = $this->addPersonToTreeLevel($tree[0], $personObj->getFields());
			
			$tree[0] = $this->addMarriagesToTreeLevel($tree[0]);*/
			
			return $tree;
		}
		
		
		function addNextTreeDownRow($tree, $person, $depth, $maxDepth){
			
			array_push($tree, [
				'type' => 'people',
				'people' => [],
				'marriages' => []
			]);
			
			$tree[$depth] = $this->addPersonToTreeLevel($tree[$depth], $person);
			
			$tree[$depth] = $this->addMarriagesToTreeLevel($tree[$depth]);
			
			if($depth < $maxDepth){
				foreach($tree[$depth]['marriages'] as $marriage){
					foreach($marriage['children'] as $child){
						$tree = $this->addNextTreeDownRow($tree, $child, $depth + 1, $maxDepth);
					}
				}
			}
			
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
						/*array_push($tree[$depth], [
							'fields' => $parent
						]);*/
						
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
		}
		
	}
?>