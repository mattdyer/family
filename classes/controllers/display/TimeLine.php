<?php
	
	namespace classes\controllers\display;
	
	use classes\controllers\common\Response;
	use classes\views\people\PeopleView;
	use classes\controllers\people\PersonController;
	use classes\views\display\TimeLineView;
	use classes\models\people\Person;
	use classes\models\people\Marriages;
	
	class TimeLine{
		function __construct(){
			
		}
		
		
		function prepareResponse($url, $form){
			
			$response = new Response();
			
			$view = new TimeLineView();
			
			$items = $this->getSortedItems($url);
			
			$content = $view->getDefaultPageContent($items);
				
			$response->setContent($content);
			
			return $response;
		}
		
		
		function getSortedItems($url){
			
			$personObj = new Person();
			$marriageObj = new Marriages();
			
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
			
			$personView = new PeopleView();
			$personController = new PersonController();
			
			foreach($people as $person){
				array_push($items, [
					'date' => $person['birthDate'],
					'display' => $personView->personDisplay($personController->getDisplayPerson($person['id']))
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