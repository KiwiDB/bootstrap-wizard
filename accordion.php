<?php
	$config = array(
		"activeIndex" => 1,
		"bodyClass" => "accordion"
	);

	include("template/head.php");
?>



<!-- Top Block -->
<div id="topBlock" class="jumbotron topBlock-inner">
	<?php bsRows(); ?>
		<h2>Collapse (Accordion) Generator</h2>

		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur molestie tortor vitae lorem iaculis tincidunt. Nunc in aliquam quam. In hac habitasse platea dictumst. Donec imperdiet bibendum diam, vel interdum eros efficitur sit amet. Mauris libero tortor, tristique eu nulla in, fermentum viverra tellus.</p>
	<?php end_bsRows(); ?>
</div>
<!-- /Top Block -->

<!-- Main Content -->
<main>
	<?php bsRows(); ?>
		
		<h3>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras leo sem, aliquam quis nisl et, auctor dapibus nibh. Donec interdum mattis mauris, ac tincidunt augue pulvinar aliquet.</h3>

		<!-- "How Many" form -->
		<form action='accordion.php' method='post' onsubmit='accordion.updateSet(); return false;' id='howmany' class='form-inline sep-bottom'>
			<div class='form-group'>
				<label for="howmany-accordions">How many accordion items do you need?</label>
    			<input type="number" class="form-control" id="howmany-accordions" placeholder="3" min="1" max="99" step="1" maxlength="2">
			</div>

			<input type='submit' class='btn btn-default' value='Update -->' />
		</form>
		<!-- /"How Many" form -->

		<!-- Content form -->
		<form action='accordion.php' method='post' onsubmit='return false;' id='accordion-content' class='form-horizontal'>
		</form>
		<!-- /Content form -->

	<?php end_bsRows(); ?>

</main>



<?php
	include("template/footer.php");
?>