<?php
	class TimeLine{
		function __construct(){
			
		}
		
		
		function prepareResponse($url, $form){
			
			$response = LoadClass(SiteRoot . '/classes/controllers/common/Response');
			
			$view = LoadClass(SiteRoot . '/classes/views/display/TimeLineView');
			
			$items = $this->getSortedItems($url);
			
			$content = $view->getDefaultPageContent($items);
				
			$response->setContent($content);
			
			return $response;
		}
		
		
		function getSortedItems($url){
			
			$personObj = LoadClass(SiteRoot . '/classes/models/people/Person');
			$marriageObj = LoadClass(SiteRoot . '/classes/models/people/Marriages');
			
			$people = $personObj->findBy([
				'equalsValues' => [
					'live' => 1
				]
			]);
			
			$marriages = $marriageObj->findBy([
				'equalsValues' => [
					'live' => 1
				]
			]);
			
			
			$items = [];
			
			foreach($people as $person){
				array_push($items, [
					'date' => $person['birthDate'],
					'display' => '<strong>Person:</strong> ' . $person['firstName'] . ' ' . $person['lastName']
				]);
			}
			
			foreach($marriages as $marriage){
				array_push($items, [
					'date' => $marriage['startDate'],
					'display' => '<strong>Marriage:</strong> ' . $marriage['lastName']
				]);
			}
			
			usort($items, [TimeLine::class, "compareItems"]);
			
			
			return $items;
		}
		
		
		function compareItems($item1, $item2){
			
			$result = 0;
			
			if(strtotime($item1['date']) > strtotime($item2['date'])){
				$result = 1;
			}
			
			if(strtotime($item1['date']) < strtotime($item2['date'])){
				$result = -1;
			}
			
			return $result;
		}
		
		
	}
?>