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
				],
				[
					"firstName" => "Ray",
					"lastName" => "Dyer",
					"birthDate" => "1951-03-31"
				],
				[
					"firstName" => "Margo",
					"lastName" => "Young",
					"birthDate" => "1948-06-21"
				],
				[
					"firstName" => "Ricky",
					"lastName" => "David",
					"birthDate" => "1900-01-01"
				],
				[
					"firstName" => "Tammy",
					"lastName" => "McLean",
					"birthDate" => "1900-01-01"
				]
			];
			
			return $records;
		}
		
		
		function getParentChildRecords(){
			$records = [
				[
					"parentID" => "MatthewDyer1979-12-20",
					"childID" => "JacobDyer2010-03-05"
				],
				[
					"parentID" => "JessicaDavid1983-11-03",
					"childID" => "JacobDyer2010-03-05"
				],
				[
					"parentID" => "MatthewDyer1979-12-20",
					"childID" => "WilliamDyer2012-02-21"
				],
				[
					"parentID" => "JessicaDavid1983-11-03",
					"childID" => "WilliamDyer2012-02-21"
				],
				[
					"parentID" => "MatthewDyer1979-12-20",
					"childID" => "TerryDyer2013-07-07"
				],
				[
					"parentID" => "JessicaDavid1983-11-03",
					"childID" => "TerryDyer2013-07-07"
				],
				[
					"parentID" => "MatthewDyer1979-12-20",
					"childID" => "KatherineDyer2015-12-04"
				],
				[
					"parentID" => "JessicaDavid1983-11-03",
					"childID" => "KatherineDyer2015-12-04"
				],
				[
					"parentID" => "RayDyer1951-03-31",
					"childID" => "MatthewDyer1979-12-20"
				],
				[
					"parentID" => "MargoYoung1948-06-21",
					"childID" => "MatthewDyer1979-12-20"
				],
				[
					"parentID" => "RickyDavid1900-01-01",
					"childID" => "JessicaDavid1983-11-03"
				],
				[
					"parentID" => "TammyMcLean1900-01-01",
					"childID" => "JessicaDavid1983-11-03"
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
				],
				[
					"spouseID1" => "RickyDavid1900-01-01",
					"spouseID2" => "TammyMcLean1900-01-01",
					"startDate" => "1900-01-01",
					"lastName" => "David"
				],
				[
					"spouseID1" => "RayDyer1951-03-31",
					"spouseID2" => "MargoYoung1948-06-21",
					"startDate" => "1900-01-01",
					"lastName" => "Dyer"
				]
			];
			
			return $records;
		}
		
		
	}
?>