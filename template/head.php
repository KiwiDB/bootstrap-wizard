<?php
	function setDefaults($config)
	{
		!isset($config["title"]) ? $config["title"] = "Bootstrap Wizard" : "";
		!isset($config["activeIndex"]) ? $config["activeIndex"] = 0 : "";
		!isset($config["bodyClass"]) ? $config["bodyClass"] = "default" : "";

		return $config;
	}

	function bsRows()
	{
		echo("<div class='row'>
				<div class='col-lg-offset-2 col-lg-8'>");
	}

	function end_bsRows()
	{
		echo("</div>
				</div>");
	}

	$config = setDefaults($config);
?>

<html>
	<head>
		<title><?php echo($config["title"]); ?></title>

		<style>
		</style>

		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">

		<link rel="stylesheet" href="style.css.php">


		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>

		<script src="lib/handlebars-v3.0.0.js"></script>

		<script src="scripts.js"></script>

		<!-- Templates -->
		<?php if($config["bodyClass"] == "accordion") : ?>
			<script id="accordion-form-template" type="text/x-handlebars-template">
				{{#times repeat}}
					<div class='accordion-group'>
						<div class='form-group'>
							<label for="acc-title-{{this}}" class="col-sm-2 control-label">Title</label>
						    <div class="col-sm-10">
						      <input type="text" class="form-control acc-title" id="acc-title-{{this}}" placeholder="Title" />
						    </div>
						</div>
						<div class='form-group'>
							<label for="acc-body-{{this}}" class="col-sm-2 control-label">Body</label>
						    <div class="col-sm-10">
						      <textarea class="form-control acc-body" id="acc-body-{{this}}" placeholder="Body"></textarea>
						    </div>
						</div>
					</div>
				{{/times}}
			</script>
		<?php endif; ?>
	</head>

	<body class="<?php echo($config["bodyClass"]); ?>">
		<div class='container-fluid'>
			<!-- Top Nav -->
			<?php bsRows(); ?>
				<nav class="navbar navbar-default">
				  <div class="container-fluid">
				    <!-- Brand and toggle get grouped for better mobile display -->
				    <div class="navbar-header">
				      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				        <span class="sr-only">Toggle navigation</span>
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
				      </button>
				      <a class="navbar-brand" href="index.php">Bootstrap Wizard</a>
				    </div>

				    <!-- Collect the nav links, forms, and other content for toggling -->
				    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				      <ul class="nav navbar-nav">
				        <li class="<?php echo($config["activeIndex"] == 1 ? "active" : ""); ?>"><a href="accordion.php">Collapse (Accordion) Generator <span class="sr-only">(current)</span></a></li>
				      </ul>
				    </div><!-- /.navbar-collapse -->
				  </div><!-- /.container-fluid -->
				</nav>
			<?php end_bsRows(); ?>
			<!-- /Top Nav -->