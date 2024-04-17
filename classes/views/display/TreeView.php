<?php
	//require_once(SiteRoot . '/classes/common/Record.php');
	class TreeView{
		function __construct(){
			
		}
		
		
		/*
		
		Other view options
			searchable list of all people with links to view trees
			
			timeline of people and marriages
				dates down left side of page
				people and marriages float in a box at the correct year
		
		*/
		
		
		function getDefaultPageContent(){
			return 'Tree';
		}
		
		
		function getTreeContent($tree){
			
			$personView = LoadClass(SiteRoot . '/classes/views/people/PeopleView');
			$marriageView = LoadClass(SiteRoot . '/classes/views/people/MarriageView');
			
			ob_start();
				// print_r('<pre>');
				// 	var_dump($tree);
				// print_r('</pre>');
				
				foreach($tree as $row){
					
					print_r('<div class="tree-row">');
					if($row['type'] == 'people'){
						print_r('<div class="people-row">');
							foreach($row['people'] as $person){
								
								print_r($personView->personDisplay($person));
								
							}
						print_r('</div>');
						print_r('<div class="marriage-row">');
							
							foreach($row['marriages'] as $marriage){
								
								print_r($marriageView->marriageDisplay($marriage));
								
							}
						print_r('</div>');
					}
					/*if($row['type'] == 'marriages'){
						var_dump($row['personIDs']);
						foreach($row['people'] as $marriage){
							
							print_r($marriageView->marriageDisplay($marriage));
							
						}
					}*/
					print_r('</div>');
					
				}
				
				$content = ob_get_contents();
			ob_end_clean();
			
			return $content;
		}
		
		
	}
?>