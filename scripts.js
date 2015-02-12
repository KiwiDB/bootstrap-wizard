function Accordion() {
	this.updateSet = function() {
		var num = $("#howmany-accordions").val();

		var source   = $("#accordion-form-template").html();
		var template = Handlebars.compile(source);
		var context = {repeat: num};
		var html    = template(context);

		$("#accordion-content").html(html);
	}
}


/***
**** INIT
***/
function handlebarsInit() {
	//Repeat helper
	Handlebars.registerHelper('times', function(n, block) {
	    var accum = '';
	    for(var i = 0; i < n; ++i)
	        accum += block.fn(i);
	    return accum;
	});
}


$(function() {
	handlebarsInit();
});

var accordion = new Accordion();