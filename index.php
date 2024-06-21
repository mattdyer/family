<?php
	
	include($_SERVER['DOCUMENT_ROOT'] . "/classes/AppInit.php");
	
	use classes\controllers\common\Site;
	use classes\controllers\display\TimeLine;

	if(isset($_GET['section']) AND isset($_GET['page'])){
		$site = new Site();
		$displayControllerName = 'classes\\controllers\\' . $_GET['section'] . '\\' . $_GET['page'];

		$controller = new $displayControllerName();

		$response = $controller->prepareResponse($_GET, $_POST);
		
		$response = $site->wrapContent($response);
		
		var_dump($site->getTokenTest());
		
		$hash = password_hash('test123', PASSWORD_BCRYPT);

		$valid = password_verify('test123', $hash);

		var_dump($hash);
		var_dump($valid);

		print($response->getContent());
	}
	
	
?>