<?php
	
	namespace classes\views\display;
	
	class TimeLineView{
		function __construct(){
			
		}
		
		
		function getDefaultPageContent($items){
			
			$yearScaleValue = 15;
			
			ob_start();
				echo('<div class="timeline-wrapper">');
					echo('<div class="timeline-years">');
					foreach(range(1900, 2050, 10) as $year){
						
						$top = ($year - 1900) * $yearScaleValue;
						
						echo("<div class=\"timeline-year\" style=\"top: {$top}px\">$year</div>");
					}
					echo('</div>');
					echo('<div class="timeline-items">');
						foreach($items as $item){
							
							$yearValue = strtotime($item['date']) / (60 * 60 * 24 * 365);
							
							$yearValueAdjusted = $yearValue + 71;
							
							$top = $yearValueAdjusted * $yearScaleValue;
							
							echo("<div class=\"timeline-item\" style=\"top: {$top}px\" tabindex=\"0\">");
							echo("<label>");
							echo("<input type=\"checkbox\">");
							echo($item['date'] . ' ' . $item['display']);
							echo("</label>");
							echo('</div>');
						}
					echo('</div>');
				echo('</div>');
				
				$content = ob_get_contents();
			ob_end_clean();
			
			return $content;
		}
		
		
	}
?>