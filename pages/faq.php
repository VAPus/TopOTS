<div class="accordion" id="accordion2">
	<?php
	$i=0;
	foreach($_LANG['faq'] as $faq){
		$i++;
		echo'
		<div class="accordion-group">
			<div class="accordion-heading">
				<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion3" href="#collapse'.$i.'">
					'.$faq['title'].'
				</a>
			</div>
			<div id="collapse'.$i.'" class="accordion-body collapse">
				<div class="accordion-inner">
					'.$faq['message'].'
				</div>
			</div>
		</div>';
	}
	?>
</div>