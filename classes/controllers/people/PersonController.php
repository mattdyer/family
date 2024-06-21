<?php
	
	namespace classes\controllers\people;

	use classes\models\people\Person;
	use classes\models\people\ParentChild;
	use classes\models\people\Marriages;
	use classes\controllers\people\MarriageController;
	
	class PersonController{
		function __construct(){
			
		}
		
		
		function getParents($personID){
			
			$personObj = new Person();
			$parentChild = new ParentChild();
			
			$parentRelationships = $parentChild->findBy([
				"equalsValues" => [
					"childID" => $personID
				]
			]);
			
			$parentIDs = array_map(fn($row): int => $row['parentID'], $parentRelationships);
			
			
			$parents = $personObj->findBy([
				"inListValues" => [
					"id" => $parentIDs
				]
			]);
			
			
			return $parents;
		}
		
		
		function getChildren($personID){
			
			$personObj = new Person();
			$parentChild = new ParentChild();
			
			$childRelationships = $parentChild->findBy([
				"equalsValues" => [
					"parentID" => $personID
				]
			]);
			
			$childIDs = array_map(fn($row): int => $row['childID'], $childRelationships);
			
			
			$children = $personObj->findBy([
				"inListValues" => [
					"id" => $childIDs
				]
			]);
			
			
			return $children;
		}
		
		
		function getSiblings($personID){
			
			$personObj = new Person();
			$parentChild = new ParentChild();
			
			$parentRelationships = $parentChild->findBy([
				"equalsValues" => [
					"childID" => $personID
				]
			]);
			
			$parentIDs = array_map(fn($row): int => $row['id'], $parentRelationships);
			
			
			$childRelationships = $parentChild->findBy([
				"inListValues" => [
					"parentID" => $parentIDs
				]
			]);
			
			$childIDs = array_map(fn($row): int => $row['childID'], $childRelationships);
			
			$siblings = $personObj->findBy([
				"inListValues" => [
					"id" => $childIDs
				]
			]);
			
			
			return $siblings;
		}
		
		
		function getDisplayPerson($personID){
			
			$personObj = new Person();
			
			$personObj->load($personID);
			
			$person = $personObj->getFields();
			
			$currentLastName = $this->getCurrentLastName($person['id'], $person['lastName'], time());
			
			$displayPerson = [
				'fields' => $person,
				'currentLastName' => $currentLastName,
				'displayLastName' => $this->getDisplayLastName($currentLastName, $person['lastName'])
			];
			
			return $displayPerson;
		}
		
		
		function getCurrentLastName($personID, $lastName, $currentTime){
			
			$marriage = new Marriages();
			
			
			$marriageRecords = $marriage->findBy([
				'equalsValues' => [
					'spouseID1' => $personID
				]
			]);
			
			$marriageController = new MarriageController();
			
			$currentLastName = $lastName;
			
			$marriages = $marriageController->getMarriageRecordsForPersonIDs([$personID]);
			
			foreach($marriages as $marriage){
				
				if($marriage['startDate'] < $currentTime AND $marriage['endDate'] == ''){
					$currentLastName = $marriage['lastName'];
				}else if($marriage['startDate'] < $currentTime AND $marriage['endDate'] > $currentTime){
					$currentLastName = $marriage['lastName'];
				}
				
			}
			
			return $currentLastName;
		}
		
		
		function getDisplayLastName($currentLastName, $originalLastName){
			
			$displayLastName = $originalLastName;
			
			if($currentLastName != $originalLastName){
				$displayLastName = "($originalLastName) $currentLastName";
			}
			
			return $displayLastName;
		}
		
	}
?>