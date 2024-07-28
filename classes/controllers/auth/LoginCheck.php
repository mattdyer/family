<?php
	
	namespace classes\controllers\auth;

    use classes\controllers\common\Site;
    use classes\controllers\common\Response;
    use classes\models\common\User;

	class LoginCheck{
		function __construct(){
			
		}
        
        function prepareResponse($url, $form){
			
			$response = new Response();
			
			$response->setType('redirect');

            $user = new User();

            $user->loadBy([
                'equalsValues' => [
                    'username' => $form['Username']
                ]
            ]);


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