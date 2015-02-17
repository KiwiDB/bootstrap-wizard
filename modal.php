<?php
	$config = array(
		"activeIndex" => 2,
		"bodyClass" => "modal-wiz"
	);

	include("template/head.php");
?>



<!-- Top Block -->
<div id="topBlock" class="jumbotron topBlock-inner">
	<?php bsRows(); ?>
		<h2>Modal Generator</h2>

		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur molestie tortor vitae lorem iaculis tincidunt. Nunc in aliquam quam. In hac habitasse platea dictumst. Donec imperdiet bibendum diam, vel interdum eros efficitur sit amet. Mauris libero tortor, tristique eu nulla in, fermentum viverra tellus.</p>
	<?php end_bsRows(); ?>
</div>
<!-- /Top Block -->

<!-- Main Content -->
<main>
	<?php bsRows(); ?>
		
		<h3>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras leo sem, aliquam quis nisl et, auctor dapibus nibh. Donec interdum mattis mauris, ac tincidunt augue pulvinar aliquet.</h3>

		<!-- Content form -->
		<form action='modal.php' method='post' onsubmit='modal.generate(); return false;' id='modal-content-form' class='form-horizontal sep-top'>
			<div class='content-container'>
				<h2>Modal</h2>
				<div class='form-group'>
					<label for="mod-title" class="col-sm-2 col-xs-2 control-label">Title</label>
				    <div class="col-sm-7 col-xs-4">
				      <input type="text" class="form-control" id="mod-title" placeholder="Title" name='title' />
				    </div>
				</div>
				<div class='form-group'>
					<label for="mod-body" class="col-sm-2 col-xs-2 control-label">Body</label>
				    <div class="col-sm-7 col-xs-4">
				      <textarea class="form-control" id="mod-body" placeholder="Body" name='body'></textarea>
				    </div>
				</div>
			</div>

			<div class='content-container'>
				<h2>Trigger Button</h2>
				<div class='form-group'>
					<label for="mod-btn-text" class="col-sm-2 col-xs-2 control-label">Text</label>
				    <div class="col-sm-7 col-xs-4">
				      <input type="text" class="form-control" id="mod-btn-text" placeholder="Text" name='btn-text' />
				    </div>
				</div>
			</div>

			<input type='submit' id='generateModBtn' class='btn btn-default' value='Generate Modal Code' />
		</form>
		<!-- /Content form -->

		<div id="output" class="sep-top" style="display:none">
			<!-- Code Output -->
			<div id="code-container" class="brush: js"></div>

			<!-- Preview -->
			<div id="preview"></div>
		</div>

	<?php end_bsRows(); ?>

</main>



<?php
	include("template/footer.php");
?>