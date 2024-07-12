<?php
	
	namespace classes\views\display;

	class LoginView{
		function __construct(){
			
		}
		
		function getDefaultPageContent(){
			ob_start();
				print_r('<div class="login-form">');
                    print_r('<form method="Post" action="?section=auth&page=LoginCheck">');
                        print_r('<input type="text" name="Password">');
                        print_r('<input type="submit" name="Submit" value="Submit">');
                    print_r('</form>');

				
				print_r('</div>');
				
				$content = ob_get_contents();
			ob_end_clean();
			
			return $content;
		}
		
    }
?>