<?php
	//require_once(SiteRoot . '/classes/common/Record.php');
	class Setup{
		function __construct(){
			
		}
		
		
		function prepareResponse($url, $form){
			
			$this->setupTables();
			
			$response = LoadClass(SiteRoot . '/classes/controllers/common/Response');
			
			$view = LoadClass(SiteRoot . '/classes/views/common/SetupView');
			
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
			$records = [
				[
					"firstName" => "Matthew",
					"lastName" => "Dyer",
					"birthDate" => "1979-12-20"
				],
				[
					"firstName" => "Jessica",
					"lastName" => "David",
					"birthDate" => "1983-11-03"
				],
				[
					"firstName" => "Jacob",
					"lastName" => "Dyer",
					"birthDate" => "2010-03-05"
				],
				[
					"firstName" => "William",
					"lastName" => "Dyer",
					"birthDate" => "2012-02-21"
				],
				[
					"firstName" => "Terry",
					"lastName" => "Dyer",
					"birthDate" => "2013-07-07"
				],
				[
					"firstName" => "Katherine",
					"lastName" => "Dyer",
					"birthDate" => "2015-12-04"
				]
			];
			
			return $records;
		}
		
		
		function getParentChildRecords(){
			$records = [
				[
					"parentID" => "MatthewDyer1979-12-20",
					"childID" => "JacobDyer2010-03-05"
				]
			];
			
			return $records;
		}
		
		
		function getMarriageRecords(){
			$records = [
				[
					"spouseID1" => "MatthewDyer1979-12-20",
					"spouseID2" => "JessicaDavid1983-11-03",
					"startDate" => "2008-07-19",
					"lastName" => "Dyer"
				]
			];
			
			return $records;
		}
		
		
	}
?>