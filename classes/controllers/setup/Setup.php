<?php
	//require_once(SiteRoot . '/classes/common/Record.php');
	class Setup{
		function __construct(){
			
		}
		
		
		function prepareResponse($url, $form){
			
			$this->setupTables();
			
			$response = LoadClass(SiteRoot . '/classes/controllers/common/Response');
			
			$view = LoadClass(SiteRoot . '/classes/views/setup/SetupView');
			
			$content = $view->getPageContent();
			
			$response->setContent($content);
			
			return $response;
		}
		
		
		function setupTables(){
			
			$person = LoadClass(SiteRoot . '/classes/models/people/Person');
	
			$person->setupTable($this->getPersonRecords());
			
			$parentChild = LoadClass(SiteRoot . '/classes/models/people/ParentChild');
	
			$parentChild->setupTable($this->getParentChildRecords());
			
			$marriage = LoadClass(SiteRoot . '/classes/models/people/Marriages');
	
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