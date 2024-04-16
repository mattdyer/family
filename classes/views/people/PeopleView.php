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
				print_r(' ');
				print_r("<a href=\"?section=display&page=Tree&personID={$person['fields']['id']}\">up</a>");
				print_r(' ');
				print_r("<a href=\"?section=display&page=TreeDown&personID={$person['fields']['id']}\">down</a>");
				
				
				print_r('</div>');
				
				$content = ob_get_contents();
			ob_end_clean();
			
			return $content;
		}
		
		
	}
?>