<?php
	
	namespace classes\controllers\common;
	
	class Response{
		function __construct(){
			$this->content = '';	
		}
		
		
		
		function setContent($newContent){
			$this->content = $newContent;
		}
		
		function getContent(){
			return $this->content;
		}
		
		
	}
?>