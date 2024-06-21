<?php
	
	namespace classes\controllers\common;
	
	use ReallySimpleJWT\Token;
	use classes\views\common\SiteView;

	class Site{
		function __construct(){
			
		}
		
		
		function wrapContent($response){
			$view = new SiteView();
			
			$response->setContent($view->mainTemplate($response->getContent()));
			
			return $response;
		}
		
		function getTokenTest(){
			$userId = 12;
			$secret = 'sec!ReT423*&';
			$expiration = time() + 3600;
			$issuer = 'localhost';

			$token = Token::create($userId, $secret, $expiration, $issuer);

			return $token;
		}

	}
?>