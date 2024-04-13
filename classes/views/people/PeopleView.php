<?php
	class PeopleView{
		function __construct(){
			
		}
		
		
		/*
		
		
			People should show up once under their parents, or at the top of the tree if they are the top.
			
			Then they should show in each marriage they are part of.  Below the marriage show the children 
			and these each start a new tree.
		
		
		*/
		
		
		
		function personDisplay($person){
			ob_start();
				print_r('<div class="person-container">');
				print_r($person['fields']['firstName']);
				print_r(' ');
				print_r($person['displayLastName']);
				
				/*foreach($person['marriages'] as $marriage){
					print_r("<div class=\"marriage-{$marriage['fields']['id']}\" data-marriageid=\"{$marriage['fields']['id']}\">Married: ");
					print_r($marriage['fields']['startDate']);
					if($marriage['fields']['endDate'] == ''){
						print_r(' - Present');
					}else{
						print_r($marriage['fields']['endDate']);
					}
					print_r('</div>');
				}*/
				
				print_r('</div>');
				
				$content = ob_get_contents();
			ob_end_clean();
			
			return $content;
		}
		
		
	}
?>