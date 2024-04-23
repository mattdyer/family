<?php
	
	include($_SERVER['DOCUMENT_ROOT'] . "/classes/AppInit.php");
	
	if(isset($_GET['section']) AND isset($_GET['page'])){
		$site = LoadClass(SiteRoot . '/classes/controllers/common/Site');
		$controller = LoadClass(SiteRoot . '/classes/controllers/' . $_GET['section'] . '/' . $_GET['page']);
		
		$response = $controller->prepareResponse($_GET, $_POST);
		
		$response = $site->wrapContent($response);
		
		var_dump($site->getTokenTest());

		print($response->getContent());
	}
	
	
?>