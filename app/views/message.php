<div style="border-radius: 0px !important; margin: 0px;" class="alert alert-<?=$class?> alert-dismissible">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	<?php
		$center = empty($message) ? 'text-center' : '';

		if (isset($title) && !empty($title)) :
	?>
	<h4 class="<?=$center?>">
		<i class="icon fa <?=$icone?>"></i> <?=$title?>
	</h4>

	<?php
		endif;
	?>
	<?=$message?>
</div>