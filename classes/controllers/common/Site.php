<?php
	
	namespace classes\controllers\common;
	
	use ReallySimpleJWT\Token;
	use classes\views\common\SiteView;

	class Site{
		function __construct(){
			$this->tokenSecret = 'fjjsf^&fjd7f66dj9au$fdDR';
		}
		
		
		function wrapContent($response){
			$view = new SiteView();
			
			$response->setContent($view->mainTemplate($response->getContent()));
			
			return $response;
		}
		
		function generateLoginToken(){
			$userId = 0;
			
			$expiration = time() + 3600;
			$issuer = 'localhost';

			$token = Token::create($userId, $this->tokenSecret, $expiration, $issuer);

			return $token;
		}

		function checkLoginToken($token){
			$result = Token::validate($token, $this->tokenSecret);

			return $result;
		}

	}
?>