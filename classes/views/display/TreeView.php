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
				var_dump($tree);
				echo('Tree Display');
				$content = ob_get_contents();
			ob_end_clean();
			
			return $content;
		}
		
		
	}
?>