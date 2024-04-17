<?php
	class SiteView{
		function __construct(){
			
		}
		
		
		function mainTemplate($content){
			
			ob_start();
				
				echo('<!DOCTYPE html>
				<html>
				<head>
					<meta charset="utf-8">
					<meta name="viewport" content="width=device-width, initial-scale=1">
					<title>Family Tree</title>
					<link rel="stylesheet" type="text/css" href="/assets/css/styles.css">
					<script type="text/javascript" src="/assets/js/scripts.js"></script>
				</head>
				<body>
					<div class="nav-container">
						<div class="nav-item"><a href="?section=display&page=ListController">List</a></div>
					</div>
				
				');
				
				print_r($content);
				
				echo('</body>
					</html>');
				
				$wrappedContent = ob_get_contents();
			ob_end_clean();
			
			return $wrappedContent;
		}
		
		
	}
?>