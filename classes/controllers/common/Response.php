<?php
	
	namespace classes\controllers\common;
	
	class Response{
		function __construct(){
			$this->type = 'content';
			$this->content = '';
			$this->redirectURL = '';
		}
		

		function getType(){
			return $this->type;
		}


		function setType($newType){
			$this->type = $newType;
		}


		function setRedirectURL($newRedirectURL){
			$this->redirectURL = $newRedirectURL;
		}
		
		function getRedirectURL(){
			return $this->redirectURL;
		}

		
		function setContent($newContent){
			$this->content = $newContent;
		}
		
		function getContent(){
			return $this->content;
		}
		
		
	}
?>