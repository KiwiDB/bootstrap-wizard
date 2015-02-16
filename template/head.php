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
				<div class='col-lg-offset-2 col-lg-8 col-md-offset-1 col-md-10'>");
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
		<script src="lib/jquery.scrollTo-1.4.14/jquery.scrollTo.min.js"></script>


		<link href="http://alexgorbatchev.com/pub/sh/current/styles/shCore.css" rel="stylesheet" type="text/css" />
		<link href="http://alexgorbatchev.com/pub/sh/current/styles/shThemeDefault.css" rel="stylesheet" type="text/css" />
		<script src="http://alexgorbatchev.com/pub/sh/current/scripts/shCore.js" type="text/javascript"></script>
		<script src="http://alexgorbatchev.com/pub/sh/current/scripts/shAutoloader.js" type="text/javascript"></script>
		<script src="http://alexgorbatchev.com/pub/sh/current/scripts/shBrushJScript.js" type="text/javascript"></script>


		<script src="scripts.js"></script>



<!-- Templates -->
		<?php /* ACCORDION*/ if($config["bodyClass"] == "accordion") : ?>

	<!-- Accordion Form -->
<script id="accordion-form-template" type="text/x-handlebars-template">
<div class='accordion-options'>
	<label class="checkbox-inline">
		<input type="checkbox" id="addP" checked="true" /> Add P-tags to Body
	</label>
</div>
{{#times repeat}}
<div class='accordion-group'>
	<div class='form-group'>
		<label for="acc-title-{{this}}" class="col-sm-2 col-xs-2 control-label">Title</label>
	    <div class="col-sm-7 col-xs-4">
	      <input type="text" class="form-control acc-title" id="acc-title-{{this}}" placeholder="Title" name='title' />
	    </div>
	    <div class="col-sm-3 col-xs-6 checkbox acc-open-contain">
	    	<label><input type="checkbox" class="acc-open" id="acc-open-{{this}}" name='open' /> Open</label>
	    </div>
	</div>
	<div class='form-group'>
		<label for="acc-body-{{this}}" class="col-sm-2 col-xs-2 control-label">Body</label>
	    <div class="col-sm-7 col-xs-4 acc-body-txt">
	      <textarea class="form-control acc-body" id="acc-body-{{this}}" placeholder="Body" name='body'></textarea>
	    </div>
	    <ul class="col-sm-7 col-xs-4 acc-body-li" id="acc-body-li-{{this}}" style="display: none">
	    </ul>
	    <div class="col-sm-3 col-xs-6 acc-type-container">
	    	<select id="acc-type-{{this}}" name='type' class="form-control acc-type" onchange="accordion.changeType(this);">
	    		<option value="text">Text-type</option>
	    		<option value="list">List-type</option>
	    	</select>
	    	<div class="checkbox acc-hasFooter-contain">
		    	<label><input type="checkbox" class="acc-hasFooter" id="acc-hasFooter-{{this}}" name='hasFooter' onclick='accordion.footer(this)' /> Include a Footer</label>
		    </div>
	    </div>
	</div>
	<div class='form-group acc-footer-container' style="display:none">
		<label for="acc-footer-{{this}}" class="col-sm-2 col-xs-2 control-label">Footer</label>
	    <div class="col-sm-7 col-xs-4">
	      <input type="text" class="form-control acc-footer" id="acc-footer-{{this}}" placeholder="Footer" name='footer' />
	    </div>
	</div>
</div>
{{/times}}

<input type='submit' id='generateAccordionBtn' class='btn btn-default' value='Generate Accordion Code' />
</script>

	<!-- Accordion Form - LI -->
<script id="accordion-form-li" type="text/x-handlebars-template">
<li class='row acc-li-container'>
	<div class='col-sm-8'><input type='text' class='form-control' /></div>
	<div class='col-sm-4'><button class='btn btn-default btn-remove' onclick='accordion.removeLi(this); return false;'>-</button> <button class='btn btn-default btn-add' onclick='accordion.addLi(this); return false;'>+</button></div>
</li>
</script>

	<!-- Accordon HTML -->
<script id="accordion-html" type="text/x-handlebars-template">
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
	{{#data.fields}}
	<div class="panel panel-default">
		<div class="panel-heading" role="tab" id="heading{{index}}">
			<h4 class="panel-title">
				{{#if open}}
				<a data-toggle="collapse" data-parent="#accordion" href="#collapse{{index}}" aria-expanded="true" aria-controls="collapse{{index}}">
				{{else}}
				<a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse{{index}}" aria-expanded="false" aria-controls="collapse{{index}}">
				{{/if}}
					{{title}}
				</a>
			</h4>
		</div>
		{{#if open}}
		<div id="collapse{{index}}" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading{{index}}">
		{{else}}
		<div id="collapse{{index}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading{{index}}">
		{{/if}}
			{{#if type}}
			<div class="panel-body">
				{{#if ../data.config.addP}}<p>{{/if}}{{body}}{{#if ../data.config.addP}}</p>{{/if}}
			</div>
			{{else}}
			<ul class="list-group">
				{{#list}}
				<li class="list-group-item">{{this}}</li>
				{{/list}}
			</ul>
			{{/if}}
			{{#if hasFooter}}
			<div class="panel-footer">{{footer}}</div>
			{{/if}}
		</div>
	</div>
	{{/data.fields}}
</div>
</script>

	<!-- Additions required for the syntax hightlighter -->
<script id="accordion-syntax-highlighter" type="text/x-handlebars-template">
<script type="syntaxhighlighter" class="brush: js"><![CDATA[
{{data}}
]]></script>
</script>
		<?php endif; ?>
<!-- /Templates -->



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