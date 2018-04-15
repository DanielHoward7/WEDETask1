<?php if (count($ErrorMsgs) > 0): ?>
	<div class="error">
		<?php
			foreach ($ErrorMsgs as $error): ?>
				<p> <?php echo "$error"; ?> </p>
		<?php endforeach ?>
	</div>
<?php endif ?>