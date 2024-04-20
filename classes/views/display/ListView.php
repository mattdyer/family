<?php
	class ListView{
		function __construct(){
			
		}
		
		
		function getDefaultPageContent(){
			
			$personView = LoadClass(SiteRoot . '/classes/views/people/PeopleView');
			$personController = LoadClass(SiteRoot . '/classes/controllers/people/PersonController');
			
			$personObj = LoadClass(SiteRoot . '/classes/models/people/Person');
			
			$people = $personObj->findBy([
				'equalsValues' => [
					'live' => 1
				],
				'sort' => [
					[
						'column' => 'lastName',
						'direction' => 'asc'
					],
					[
						'column' => 'firstName',
						'direction' => 'asc'
					]
				]
			]);
			
			//var_dump($people);
			
			ob_start();
				foreach($people as $person){
					echo('<div class="list-view-item">');
						echo("<div class=\"person-sort\">{$person['lastName']}, {$person['firstName']}</div>");
						echo($personView->personDisplay($personController->getDisplayPerson($person['id'])));
					echo('</div>');
				}
				
				$content = ob_get_contents();
			ob_end_clean();
			
			return $content;
		}
		
		
	}
?>