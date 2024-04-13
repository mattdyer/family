<?php
	//require_once(SiteRoot . '/classes/common/Record.php');
	class TreeView{
		function __construct(){
			
		}
		
		
		function getDefaultPageContent(){
			return 'Tree';
		}
		
		
		function getTreeContent($tree){
			
			$personView = LoadClass(SiteRoot . '/classes/views/people/PeopleView');
			$marriageView = LoadClass(SiteRoot . '/classes/views/people/MarriageView');
			
			ob_start();
				//var_dump($tree);
				
				foreach($tree as $row){
					
					print_r('<div class="tree-row">');
					if($row['type'] == 'people'){
						foreach($row['people'] as $person){
							
							print_r($personView->personDisplay($person));
							
						}
						
						foreach($row['marriages'] as $marriage){
							
							print_r($marriageView->marriageDisplay($marriage));
							
						}
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