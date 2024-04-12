<?php
	//require_once(SiteRoot . '/classes/common/Record.php');
	class TreeView{
		function __construct(){
			
		}
		
		
		function getDefaultPageContent(){
			return 'Tree';
		}
		
		
		function getTreeContent($tree){
			
			ob_start();
				//var_dump($tree);
				
				foreach($tree as $row){
					
					print_r('<div class="tree-row">');
					
					foreach($row as $person){
						print_r('<span class="tree-person">');
						print_r($person['fields']['firstName']);
						print_r(' ');
						print_r($person['displayLastName']);
						
						foreach($person['marriages'] as $marriage){
							print_r($marriage['fields']['startDate']);
							if($marriage['fields']['endDate'] == ''){
								print_r(' - Present');
							}else{
								print_r($marriage['fields']['endDate']);
							}
						}
						
						print_r('</span>');
					}
					
					print_r('</div>');
					
				}
				
				$content = ob_get_contents();
			ob_end_clean();
			
			return $content;
		}
		
		
	}
?>