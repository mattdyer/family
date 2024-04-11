<?php
	require_once(SiteRoot . '/classes/models/common/Record.php');
	class ParentChild extends Record{
		function __construct(){
			record::__construct('parentChild','family','familydbphp','root','example');
		}
		
		function beforeSave(){
			if (strlen($this->fields[$this->IDColumn]) == 0){
				$this->set('dateEntered',date("Y-m-d H:i:s", time()) );
			}
		}
		
		function setupTable($records){
			
			$tableName = $this->TableName;
			
			$columns = [
				[
					"name" => "id",
					"type" => "int",
					"primaryKey" => true,
					"allowNull" => false,
					"extra" => "auto_increment"
				],
				[
					"name" => "parentID",
					"type" => "int",
					"primaryKey" => false,
					"allowNull" => false,
					"extra" => ""
				],
				[
					"name" => "childID",
					"type" => "int",
					"primaryKey" => false,
					"allowNull" => false,
					"extra" => ""
				],
				[
					"name" => "dateEntered",
					"type" => "datetime",
					"primaryKey" => false,
					"allowNull" => false,
					"extra" => ""
				]
			];
			
			$this->createTable($tableName, $columns);
			
			$records = $this->translateIdentifiers($records);
			
			$this->addRecords($records);
			
			
		}
		
		
		function translateIdentifiers($records){
			
			$person = LoadClass(SiteRoot . '/classes/models/people/Person');
			
			$newRecords = [];
			
			foreach($records as $key => $value){
				$person->reset();
				$person->loadBy(["identifier" => $value['parentID']]);
				
				$value['parentID'] = $person->get('id');
				
				$person->reset();
				$person->loadBy(["identifier" => $value['childID']]);
				
				$value['childID'] = $person->get('id');
				
				array_push($newRecords, $value);
				
			}
			
			return $newRecords;
		}
		
	}
?>