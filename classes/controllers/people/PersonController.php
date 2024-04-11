<?php
	class PersonController{
		function __construct(){
			
		}
		
		
		function getParents($personObj){
			
			$parentChild = LoadClass(SiteRoot . '/classes/models/people/ParentChild');
			
			$parentRelationships = $parentChild->findBy([
				"equalsValues" => [
					"childID" => $personObj->get('id')
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
		
		
		function getChildren($personObj){
			
			$parentChild = LoadClass(SiteRoot . '/classes/models/people/ParentChild');
			
			$childRelationships = $parentChild->findBy([
				"equalsValues" => [
					"parentID" => $personObj->get('id')
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
		
		
		function getSiblings($personObj){
			$parentChild = LoadClass(SiteRoot . '/classes/models/people/ParentChild');
			
			$parentRelationships = $parentChild->findBy([
				"equalsValues" => [
					"childID" => $personObj->get('id')
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