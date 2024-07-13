<?php
	
	namespace classes\views\setup;

	class SetupView{
		function __construct(){
			
		}
		
		
		function getPageContent($password){
			
			return 'Setup Complete password ' . $password;
		}
		
		
	}
?>