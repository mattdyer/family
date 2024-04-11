<?php
	
	include($_SERVER['DOCUMENT_ROOT'] . "/classes/AppInit.php");
	
	//var_dump($_GET);
	
	if(isset($_GET['section']) AND isset($_GET['page'])){
		$controller = LoadClass(SiteRoot . '/classes/controllers/' . $_GET['section'] . '/' . $_GET['page']);
		
		$response = $controller->prepareResponse($_GET, $_POST);
		
		print($response->getContent());
	}
	
	
?>