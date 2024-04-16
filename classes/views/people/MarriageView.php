<?php
	class MarriageView{
		function __construct(){
			
		}
		
		
		function marriageDisplay($marriage){
			
			$personView = LoadClass(SiteRoot . '/classes/views/people/PeopleView');
			
			ob_start();
				print_r('<div class="marriage-container">');
				print_r($personView->personDisplay($marriage['person1']));
				print_r($personView->personDisplay($marriage['person2']));
				/*
				print_r($marriage['person1']['fields']['firstName']);
				print_r(' and ');
				print_r($marriage['person2']['fields']['firstName']);
				print_r(' ');
				print_r($marriage['fields']['lastName']);
				print_r(' ');*/
				//print_r($marriage['fields']['startDate']);
				
				print_r('<div>');
				print_r('<div>Children:</div>');
				foreach($marriage['children'] as $child){
					print_r('<div class="child-container">');
					print_r($child['firstName']);
					print_r('</div>');
				}
				print_r('</div>');
				
				print_r('</div>');
				
				$content = ob_get_contents();
			ob_end_clean();
			
			return $content;
		}
		
		
	}
?>