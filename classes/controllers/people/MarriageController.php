<?php
	class MarriageController{
		function __construct(){
			
		}
		
		
		function getChildren($marriageID){
			
			$marriage = LoadClass(SiteRoot . '/classes/models/people/Marriages');
			$marriage->load($marriageID);
			
			$personObj = LoadClass(SiteRoot . '/classes/models/people/Person');
			$parentChild = LoadClass(SiteRoot . '/classes/models/people/ParentChild');
			
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
			
			$personController = LoadClass(SiteRoot . '/classes/controllers/people/PersonController');
			$marriage = LoadClass(SiteRoot . '/classes/models/people/Marriages');
			
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
			
			$marriage = LoadClass(SiteRoot . '/classes/models/people/Marriages');
			
			
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