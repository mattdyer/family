<?php
	
	namespace classes\models\people;

	use classes\models\common\Record;
	use classes\models\people\Person;
	
	class Marriages extends Record{
		function __construct(){
			record::__construct('marriages','family','familydbphp','root','example');
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
					"name" => "spouseID1",
					"type" => "int",
					"primaryKey" => false,
					"allowNull" => false,
					"extra" => ""
				],
				[
					"name" => "spouseID2",
					"type" => "int",
					"primaryKey" => false,
					"allowNull" => false,
					"extra" => ""
				],
				[
					"name" => "lastName",
					"type" => "varchar(100)",
					"primaryKey" => false,
					"allowNull" => true,
					"extra" => ""
				],
				[
					"name" => "startDate",
					"type" => "date",
					"primaryKey" => false,
					"allowNull" => false,
					"extra" => ""
				],
				[
					"name" => "endDate",
					"type" => "datetime",
					"primaryKey" => false,
					"allowNull" => true,
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
			
			$person = new Person();
			
			$newRecords = [];
			
			foreach($records as $key => $value){
				$person->reset();
				$person->loadBy(["equalsValues" => ["identifier" => $value['spouseID1']]]);
				
				$value['spouseID1'] = $person->get('id');
				
				$person->reset();
				$person->loadBy(["equalsValues" => ["identifier" => $value['spouseID2']]]);
				
				$value['spouseID2'] = $person->get('id');
				
				array_push($newRecords, $value);
				
			}
			
			return $newRecords;
		}
		
	}
?>