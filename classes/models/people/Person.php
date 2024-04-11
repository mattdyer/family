<?php
	require_once(SiteRoot . '/classes/models/common/Record.php');
	class Person extends Record{
		function __construct(){
			record::__construct('People','family','familydbphp','root','example');
		}
		
		function beforeSave(){
			if ($this->fields['Views'] == '' or strlen($this->fields[$this->IDColumn]) == 0){
				$this->set('Views',0);
			}
			if (strlen($this->fields[$this->IDColumn]) == 0){
				$this->set('DateEntered',date("Y-m-d H:i:s", time()) );
			}
		}
		
		function setupTable(){
			
			$tableName = "People";
			
			$columns = [
				[
					"name" => "id",
					"type" => "int",
					"primaryKey" => true,
					"allowNull" => false
				],
				[
					"name" => "firstName",
					"type" => "varchar(100)",
					"primaryKey" => false,
					"allowNull" => true
				]
			];
			
			$createSQL = "CREATE TABLE IF NOT EXISTS $tableName(";
			
			$primaryKey = [];
			
			foreach($columns as $key => $column){
				
				$columnSQL = '';
				
				if($column['primaryKey']){
					array_push($primaryKey, "`{$column['name']}`");
				}
				
				//$columnSQL = "{$column['name']} NOT NULL";
				$columnSQL = "`{$column['name']}` {$column['type']}";
				
				if($column['allowNull']){
					$columnSQL = "$columnSQL NULL";
				}else{
					$columnSQL = "$columnSQL NOT NULL";
				}
				
				$createSQL = $createSQL . ' ' . $columnSQL;
				
				if($key + 1 < sizeof($columns)){
					$createSQL = $createSQL . ',';
				}
			}
			
			if(sizeof($primaryKey)){
				$createSQL = $createSQL . ",PRIMARY KEY (" . join(',', $primaryKey) . ")";
			}
			
			$createSQL = $createSQL . ') ENGINE=InnoDB;';
			
			//var_dump($createSQL);
			
			$this->DoQuery($createSQL, []);
			
			
		}
		
	}
?>