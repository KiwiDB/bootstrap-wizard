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
		<script src="http://alexgorbatchev.com/pub/sh/current/scripts/shBrushXml.js" type="text/javascript"></script>


		<script src="scripts.js"></script>

		<?php 	if(isset($config["onLoad"])) : ?>
			<script type='text/javascript'>
				$(function() {
					<?php echo($config["onLoad"]); ?>
				});
			</script>
		<?php endif; ?>



<!-- Templates -->
		<?php /****
			   ****
			   **** ACCORDION
			   ****
			   ****
			   ****/ if($config["bodyClass"] == "accordion-wiz") : ?>

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
	<div class='col-sm-4 btn-group' role="group" aria-label="Add or Remove Row"><button class='btn btn-default btn-remove' onclick='accordion.removeLi(this); return false;'>-</button> <button class='btn btn-default btn-add' onclick='accordion.addLi(this); return false;'>+</button></div>
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
		<?php endif; ?>

		<?php /****
			   ****
			   **** MODAL
			   ****
			   ****
			   ****/ if($config["bodyClass"] == "modal-wiz") : ?>

<!-- Modal Form -->
<script id="modal-code" type="text/x-handlebars-template">
<!-- Button trigger modal -->
<button type="button" class="{{data.btn.class}}" data-toggle="modal" data-target="#{{data.modal.id}}">
  {{data.btn.text}}
</button>

<!-- Modal -->
{{#if data.modal.fade}}
<div class="modal fade" id="{{data.modal.id}}" tabindex="-1" role="dialog" aria-labelledby="{{data.modal.id}}Label" aria-hidden="true">
{{else}}
<div class="modal" id="{{data.modal.id}}" tabindex="-1" role="dialog" aria-labelledby="{{data.modal.id}}Label" aria-hidden="true">
{{/if}}
{{#ifCond data.modal.size 'lg'}}
  <div class="modal-dialog modal-lg">
{{/ifCond}}
{{#ifCond data.modal.size 'sm'}}
  <div class="modal-dialog modal-sm">
{{/ifCond}}
{{#ifCond data.modal.size 'no'}}
  <div class="modal-dialog">
{{/ifCond}}
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="{{data.modal.id}}Label">{{data.modal.title}}</h4>
      </div>
      <div class="modal-body">
        {{{data.modal.body}}}
      </div>
      <div class="modal-footer">
      	{{#data.modal.btns}}
      	{{#ifCond btn-type 'btn'}}
      	<button type="button" class="{{btn-class}}" onclick='{{btn-click}}'{{#if close}} data-dismiss="modal"{{/if}}>{{btn-text}}</button>
      	{{/ifCond}}
      	{{#ifCond btn-type 'a'}}
      	<a href='{{btn-href}}' target='{{btn-target}}' class='{{btn-class}}'{{#if close}} data-dismiss="modal"{{/if}}>{{btn-text}}</a>
      	{{/ifCond}}
      	{{/data.modal.btns}}
      </div>
    </div>
  </div>
</div>
</script>

<script id="modal-form-btn" type="text/x-handlebars-template">
<li class='btn-row'>
	<div class='form-inline row btn-type-row'>
		<div class='form-group col-sm-6'>
			<label for="btn-type-{{index}}">Type</label>
    		<select id='btn-type-{{index}}' name='btn-type' class='form-control' onchange='modal.changeBtnType(this)'>
    			<option value='btn'>Button</option>
    			<option value='a'>A-tag</option>
    		</select>
    	</div>
    	<div class='col-sm-6 btn-addremove' role="group" aria-label="Add or Remove Row">
    		<button class='btn btn-default btn-remove' onclick='modal.removeBtn(this); return false;'>-</button> 
    		<button class='btn btn-default btn-add' onclick='modal.addBtn(this); return false;'>+</button>
    	</div>
    </div>
    <div class='row btn-fields btn-fields-all sep-top'>
		<div class='form-group col-sm-4'>
			<label for="btn-text-{{index}}">Button Text</label>
			<input type='text' class='form-control' id='btn-text-{{index}}' name='btn-text' placeholder='Text' />
		</div>
		<div class='form-group col-sm-4'>
			<label for="btn-class-{{index}}">Button Class</label>
			<input type='text' class='form-control' id='btn-class-{{index}}' name='btn-class' placeholder='Class' />
		</div>
		<div class='form-group col-sm-4 checkbox'>
			<label><input type="checkbox" id="btn-close-{{this}}" name='close' /> Close Modal when Clicked</label>
		</div>
	</div>
    <div class='btn-fields btn-type-btn'>
		<div class='row'>
			<div class='form-group col-sm-12'>
				<label for="btn-click-{{index}}">onClick Property</label>
				<input type='text' class='form-control' id='btn-click-{{index}}' name='btn-click' placeholder='onClick' />
			</div>
		</div>
	</div>
	<div class='btn-fields btn-type-a' style='display:none'>
		<div class='row'>
			<div class='form-group col-sm-6'>
				<label for="btn-href-{{index}}">HREF Property</label>
				<input type='text' class='form-control' id='btn-href-{{index}}' name='btn-href' placeholder='HREF' />
			</div>
			<div class='form-group col-sm-6'>
				<label for="btn-target-{{index}}">Target Window</label>
				<select class='form-control' id='btn-target-{{index}}' name='btn-target'>
					<option value='_self'>Same Window</option>
					<option value='_blank'>New Window</option>
				</select>
			</div>
		</div>
	</div>
</li>
</script>

			   <?php endif; ?>

<!-- Additions required for the syntax hightlighter -->
<script id="syntax-highlighter" type="text/x-handlebars-template">
<script type="syntaxhighlighter" class="brush: xml"><![CDATA[
{{data}}
]]></script>
</script>
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
				        <li class="<?php echo($config["activeIndex"] == 1 ? "active" : ""); ?>"><a href="accordion.php">Collapse (Accordion) Generator<?php if($config["activeIndex"] == 1) : ?> <span class="sr-only">(current)</span><?php endif; ?></a></li>
				        <li class="<?php echo($config["activeIndex"] == 2 ? "active" : ""); ?>"><a href="modal.php">Modal Generator<?php if($config["activeIndex"] == 1) : ?> <span class="sr-only">(current)</span><?php endif; ?></a></li>
				      </ul>
				    </div><!-- /.navbar-collapse -->
				  </div><!-- /.container-fluid -->
				</nav>
			<?php end_bsRows(); ?>
			<!-- /Top Nav -->