<?php
	
	namespace classes\views\setup;

	class SetupOptionsView{
		function __construct(){
			
		}
		
		
		function getPageContent(){
			
            ob_start();
                ?>
                    <form method="Post" action="?section=setup&page=Setup">
                        <input type="text" placeholder="Starting Password" name="startingPassword">
                        <input type="submit" name="Submit" value="Submit">
                    </form>
                <?php
                $content = ob_get_contents();
			ob_end_clean();

			return $content;
		}
		
		
	}
?>