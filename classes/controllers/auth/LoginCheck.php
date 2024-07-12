<?php
	
	namespace classes\controllers\auth;

    use classes\controllers\common\Site;
    use classes\controllers\common\Response;

	class LoginCheck{
		function __construct(){
			
		}
        
        function prepareResponse($url, $form){
			
			$response = new Response();
			
			$response->setType('redirect');


            if(isset($_POST['Password']) AND $_POST['Password'] == 'SecretPassword'){

                $site = new Site();

                $loginToken = $site->generateLoginToken();

                setcookie('familyauth', $loginToken, 0, '/', '', false, true);

                $response->setRedirectURL('?section=display&page=ListController');

            }else{

                $response->setRedirectURL('?section=display&page=Login');

            }

			
			return $response;
		}
		
		
	}
?>