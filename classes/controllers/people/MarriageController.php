<?php
	
	namespace classes\controllers\people;

	use classes\controllers\people\PersonController;
	use classes\models\people\Person;
	use classes\models\people\ParentChild;
	use classes\models\people\Marriages;
	
	class MarriageController{
		function __construct(){
			
		}
		
		
		function getChildren($marriageID){
			
			$marriage = new Marriages();
			$marriage->load($marriageID);
			
			$personObj = new Person();
			$parentChild = new ParentChild();
			
			$childRelationships1 = $parentChild->findBy([
				"equalsValues" => [
					"parentID" => $marriage->get('spouseID1')
				]
			]);
			
			$childRelationships2 = $parentChild->findBy([
				"equalsValues" => [
					"parentID" => $marriage->get('spouseID2')
				]
			]);
			
			$childIDs1 = array_map(fn($row): int => $row['childID'], $childRelationships1);
			$childIDs2 = array_map(fn($row): int => $row['childID'], $childRelationships2);
			
			$childIDs = array_intersect($childIDs1, $childIDs2);
			
			$children = $personObj->findBy([
				"inListValues" => [
					"id" => $childIDs
				]
			]);
			
			return $children;
		}
		
		
		function getMarriages($personIDs){
			
			$personController = new PersonController();;
			$marriage = new Marriages();
			
			$marriageRecords = $this->getMarriageRecordsForPersonIDs($personIDs);
			
			$marriages = [];
			
			foreach($marriageRecords as $marriageRecord){
				$person1 = $personController->getDisplayPerson($marriageRecord['spouseID1']);
				
				$person2 = $personController->getDisplayPerson($marriageRecord['spouseID2']);
				
				array_push($marriages, [
					'fields' => $marriageRecord,
					'person1' => $person1,
					'person2' => $person2
				]);
				
			}
			
			
			return $marriages;
		}
		
		
		function getMarriageRecordsForPersonIDs($personIDs){
			
			$marriage = new Marriages();;
			
			
			$marriageRecords = $marriage->findBy([
				'inListValues' => [
					'spouseID1' => $personIDs
				]
			]);
			
			$marriageIDs = array_map(fn($row): int => $row['id'], $marriageRecords);
			
			$marriageRecords = $marriage->findBy([
				'inListValues' => [
					'spouseID2' => $personIDs
				]
			]);
			
			$marriageIDs = array_merge($marriageIDs, array_map(fn($row): int => $row['id'], $marriageRecords));
			
			$marriageRecords = $marriage->findBy([
				'inListValues' => [
					'id' => $marriageIDs
				]
			]);
			
			return $marriageRecords;
		}
		
		
	}
?>