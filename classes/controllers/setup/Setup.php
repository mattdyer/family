<?php
	
	use classes\controllers\common\Response;
	use classes\views\setup\SetupView;
	use classes\models\people\Person;
	use classes\models\people\Marriages;
	use classes\models\people\ParentChild;

	class Setup{
		function __construct(){
			
		}
		
		
		function prepareResponse($url, $form){
			
			$this->setupTables();
			
			$response = new Response();
			
			$view = new SetupView();
			
			$content = $view->getPageContent();
			
			$response->setContent($content);
			
			return $response;
		}
		
		
		function setupTables(){
			
			$person = new Person();
	
			$person->setupTable($this->getPersonRecords());
			
			$parentChild = new ParentChild();
	
			$parentChild->setupTable($this->getParentChildRecords());
			
			$marriage = new Marriages();
	
			$marriage->setupTable($this->getMarriageRecords());
			
		}
		
		
		function getPersonRecords(){
			
			$personJSON = file_get_contents(SiteRoot . '/data/people.json', true);
			
			$records = json_decode($personJSON, true);
			
			return $records;
		}
		
		
		function getParentChildRecords(){
			
			$parentChildJSON = file_get_contents(SiteRoot . '/data/parentchild.json', true);
			
			$records = json_decode($parentChildJSON, true);
			
			return $records;
		}
		
		
		function getMarriageRecords(){
			
			$marriageJSON = file_get_contents(SiteRoot . '/data/marriages.json', true);
			
			$records = json_decode($marriageJSON, true);
			
			return $records;
		}
		
		
	}
?>