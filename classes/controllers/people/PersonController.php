<?php
	class PersonController{
		function __construct(){
			
		}
		
		
		function getParents($personID){
			
			$personObj = LoadClass(SiteRoot . '/classes/models/people/Person');
			$parentChild = LoadClass(SiteRoot . '/classes/models/people/ParentChild');
			
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
			
			$personObj = LoadClass(SiteRoot . '/classes/models/people/Person');
			$parentChild = LoadClass(SiteRoot . '/classes/models/people/ParentChild');
			
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
			
			$personObj = LoadClass(SiteRoot . '/classes/models/people/Person');
			$parentChild = LoadClass(SiteRoot . '/classes/models/people/ParentChild');
			
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
		
		
		function getMarriages($personID){
			
			$marriage = LoadClass(SiteRoot . '/classes/models/people/Marriages');
			$personObj = LoadClass(SiteRoot . '/classes/models/people/Person');
			
			$marriageRecords = $marriage->findBy([
				'equalsValues' => [
					'spouseID1' => $personID
				]
			]);
			
			$marriageIDs = array_map(fn($row): int => $row['id'], $marriageRecords);
			
			$marriageRecords = $marriage->findBy([
				'equalsValues' => [
					'spouseID2' => $personID
				]
			]);
			
			$marriageIDs = array_merge($marriageIDs, array_map(fn($row): int => $row['id'], $marriageRecords));
			
			$marriageRecords = $marriage->findBy([
				'inListValues' => [
					'id' => $marriageIDs
				]
			]);
			
			$marriages = [];
			
			foreach($marriageRecords as $marriageRecord){
				$personObj->reset();
				$personObj->load($marriageRecord['spouseID1']);
				
				$person1 = $personObj->getFields();
				
				$personObj->load($marriageRecord['spouseID2']);
				
				$person2 = $personObj->getFields();
				
				array_push($marriages, [
					'fields' => $marriageRecord,
					'person1' => $person1,
					'person2' => $person2
				]);
				
			}
			
			
			return $marriages;
		}
		
		
		function getCurrentLastName($personID, $lastName, $currentTime){
			
			$currentLastName = $lastName;
			
			$marriages = $this->getMarriages($personID);
			
			foreach($marriages as $marriage){
				
				if($marriage['fields']['startDate'] < $currentTime AND $marriage['fields']['endDate'] == ''){
					$currentLastName = $marriage['fields']['lastName'];
				}else if($marriage['fields']['startDate'] < $currentTime AND $marriage['fields']['endDate'] > $currentTime){
					$currentLastName = $marriage['fields']['lastName'];
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