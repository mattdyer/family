<?php
	
	namespace classes\views\display;

	class LoginView{
		function __construct(){
			
		}
		
		function getDefaultPageContent(){
			ob_start();
				?>
				<div class="login-form">
                    <form method="Post" action="?section=auth&page=LoginCheck">
						<input type="text" name="Username" placeholder="username">
						<input type="text" name="Password" placeholder="password">
                        <input type="submit" name="Submit" value="Submit">
                    </form>
				</div>
				<?php
				$content = ob_get_contents();
			ob_end_clean();
			
			return $content;
		}
		
    }
?>