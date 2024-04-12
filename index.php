<?php
	
	include($_SERVER['DOCUMENT_ROOT'] . "/classes/AppInit.php");
	
	//var_dump($_GET);
	
	if(isset($_GET['section']) AND isset($_GET['page'])){
		$site = LoadClass(SiteRoot . '/classes/controllers/common/Site');
		$controller = LoadClass(SiteRoot . '/classes/controllers/' . $_GET['section'] . '/' . $_GET['page']);
		
		$response = $controller->prepareResponse($_GET, $_POST);
		
		$response = $site->wrapContent($response);
		
		print($response->getContent());
	}
	
	
?>