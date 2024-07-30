<?php
	
	include($_SERVER['DOCUMENT_ROOT'] . "/classes/AppInit.php");
	
	use classes\controllers\common\Site;

	if(isset($_GET['section']) AND isset($_GET['page'])){
		$site = new Site();
		
		$skipLoginPage = in_array($_GET['page'], ['Login', 'LoginCheck', 'Setup', 'SetupOptions']);	

		if(isset($_COOKIE['familyauth']) OR $skipLoginPage){
			if(isset($_COOKIE['familyauth'])){
				$loginToken = $_COOKIE['familyauth'];

				$tokenResult = $site->checkLoginToken($loginToken);
			}else{
				$tokenResult = true;
			}
			
			if($tokenResult OR $skipLoginPage){
				$displayControllerName = 'classes\\controllers\\' . $_GET['section'] . '\\' . $_GET['page'];

				$controller = new $displayControllerName();

				$response = $controller->prepareResponse($_GET, $_POST);

				if($response->getType() == 'content'){
					$response = $site->wrapContent($response);
				
					print($response->getContent());
				}

				if($response->getType() == 'redirect'){
					header("Location: {$response->getRedirectURL()}");
					die();
				}
				
				
			}else{
				header("Location: index.php?section=display&page=Login&origin=3");
				die();
			}
		}else{
			header("Location: index.php?section=display&page=Login&origin=2");
			die();	
		}
	}else{
		header("Location: index.php?section=display&page=Login&origin=1");
		die();
	}
	
	
?>