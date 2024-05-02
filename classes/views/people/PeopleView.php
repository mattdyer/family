<?php
	
	namespace classes\views\people;
	
	class PeopleView{
		function __construct(){
			
		}
		
		
		function personDisplay($person){
			ob_start();
				print_r('<div class="person-container">');
				print_r($person['fields']['firstName']);
				print_r(' ');
				if(strlen($person['fields']['nickName'])){
					print_r('"' .$person['fields']['nickName'] . '"');
					print_r(' ');
				}
				print_r($person['fields']['middleName']);
				print_r(' ');
				print_r($person['displayLastName']);
				print_r(' ');
				print_r("<a class=\"tree-link\" href=\"?section=display&page=Tree&personID={$person['fields']['id']}\">up</a>");
				print_r(' ');
				print_r("<a class=\"tree-link\" href=\"?section=display&page=TreeDown&personID={$person['fields']['id']}\">down</a>");
				
				
				print_r('</div>');
				
				$content = ob_get_contents();
			ob_end_clean();
			
			return $content;
		}
		
		
	}
?>