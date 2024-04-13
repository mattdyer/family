<?php
	class MarriageView{
		function __construct(){
			
		}
		
		
		function marriageDisplay($marriage){
			ob_start();
				print_r('<div class="marriage-container">');
				print_r($marriage['fields']['lastName']);
				print_r(' ');
				print_r($marriage['fields']['startDate']);
				
				print_r('</div>');
				
				$content = ob_get_contents();
			ob_end_clean();
			
			return $content;
		}
		
		
	}
?>