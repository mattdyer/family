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
			
			return $tree;
		}
		
		
		function addNextTreeDownRow($tree, $person, $depth, $maxDepth){
			
			array_push($tree, [
				'type' => 'people',
				'people' => [],
				'marriages' => []
			]);
			
			$tree[$depth] = $this->addPersonToTreeLevel($tree[$depth], $person);
			
			$tree[$depth] = $this->addMarriagesToTreeLevel($tree[$depth], [$person['id']]);
			
			if($depth < $maxDepth){
				
				foreach($tree[$depth]['marriages'] as $marriage){
					if($marriage['person1']['id'] == $person['id'] OR $marriage['person2']['id'] == $person['id']){
						foreach($marriage['children'] as $child){
							//$depth = $depth + 1;
							$tree = $this->addNextTreeDownRow($tree, $child, $depth + 1, $maxDepth);
						}
						
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
			
			//$personIDs = array_map(fn($row): int => $row['fields']['id'], $tree[$depth - 1]['people']);
			
			//$tree[$depth - 1] = $this->addMarriagesToTreeLevel($tree[$depth - 1], $personIDs);
			
			
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
		
		
		function addMarriagesToTreeLevel($treeLevel, $personIDs){
			
			$marriageController = LoadClass(SiteRoot . '/classes/controllers/people/MarriageController');
			
			$marriages = $marriageController->getMarriages($personIDs);
			
			foreach($marriages as $key => $marriage){
				$marriages[$key]['children'] = $marriageController->getChildren($marriage['fields']['id']);
				
				array_push($treeLevel['marriages'], $marriages[$key]);
				
			}
			
			//$treeLevel['marriages'] = $marriages;
			
			// print_r('<pre>');
			// 	print('<div>ABOVE</div>');
			// 	var_dump($marriages);
			// 	var_dump($treeLevel['marriages']);
			// print_r('</pre>');
			
			//$treeLevel['marriages'] = array_merge($treeLevel['marriages'], $marriages);
			
			// print_r('<pre>');
			// 	print('<div>BELOW</div>');
			// 	var_dump($treeLevel['marriages']);
			// print_r('</pre>');
			
			return $treeLevel;
		}
		
	}
?>