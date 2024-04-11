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
		
		
	}
?>