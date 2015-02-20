function Accordion() {
	this.updateSet = function() {		
		$("#accordion-content").slideUp("fast", function() {
			var num = $("#howmany-accordions").val();

			//If we've already created accordions, we need to save the current values before destroying
			if($("#accordion-content input").length > 0)
			{
				var oldVals = {};

				$("#accordion-content input[type=text],#accordion-content textarea,#accordion-content select").each(function() {
					oldVals[$(this).attr("id")] = $(this).val();
				});

				$("#accordion-content input[type=checkbox]").each(function() {
					oldVals[$(this).attr("id")] = $(this).prop("checked");
				});

				//If LIs are populated, save them separately
				oldVals["_list"] = {};
				$(".acc-body-li").each(function() {
					var li = $(this).find("li");

					if(li.length > 0)
					{
						var lis = [];

						li.each(function() {
							lis.push($(this).find("input[type=text]").val());
						});

						oldVals["_list"][$(this).attr("id")] = lis;
					}
				});

				console.log(oldVals);
			}

			var source   = $("#accordion-form-template").html();
			var template = Handlebars.compile(source);
			var context = {repeat: num};
			var html    = template(context);

			$("#accordion-content").html(html);

			//var ind = 0;
			$(".acc-body-li").each(function() {
				//Add the first list item to each accordion (temp)
				var source   = $("#accordion-form-li").html();
				var template = Handlebars.compile(source);
				var context = {};
				var html    = template(context);

				$(this).html(html);
			});

			//If we stored old values, repopulate
			if(oldVals)
			{
				for(i in oldVals)
				{
					if($("#" + i).attr("type") == "checkbox")
						$("#" + i).prop("checked", oldVals[i]);
					else
						$("#" + i).val(oldVals[i]);
				}

				$(".acc-type").each(function() {
					accordion.changeType($(this).get(0), true);
				});

				$(".acc-hasFooter").each(function() {
					accordion.footer($(this).get(0), true);
				});

				//Special handling of LIs
				if(oldVals["_list"])
				{
					for(listitem in oldVals["_list"])
					{
						if(oldVals["_list"][listitem].length > 1)
						{
							accordion.addLi($("#" + listitem).find("li:first-child .btn-add").get(0), oldVals["_list"][listitem].length-1);
						}

						$("#" + listitem).find("li").each(function(index) {
							$(this).find("input[type=text]").val(oldVals["_list"][listitem][index]);
						});
					}
				}


/*
				$(".btn-add").each(function() {
					accordion.addLi($(this).get(0), 3);
				})
*/
			}

			//If we've already generated code, need to update the value of the button
			if($("#accordion-code-container").hasClass("code-populated"))
				$("#generateAccordionBtn").val("Update Accordion Code");

			$("#accordion-content").slideDown("fast", function() { $.scrollTo("#accordion-content", 200); });
		});
	}

	this.changeType = function(t, dontAnimate) {
		var o = $(t);
		var container = o.closest(".form-group");

		if(o.val() == "text") {
			if(dontAnimate) {
				container.find(".acc-body-li").css("display", "none");
				container.find(".acc-body-txt").css("display", "");
			}
			else {
				container.find(".acc-body-li").fadeOut("fast", function() {
					container.find(".acc-body-txt").fadeIn("fast");
				});
			}
		}
		else
		{
			if(dontAnimate) {
				container.find(".acc-body-li").css("display", "");
				container.find(".acc-body-txt").css("display", "none");
			}
			else {
				container.find(".acc-body-txt").fadeOut("fast", function() {
					container.find(".acc-body-li").fadeIn("fast");
				});
			}
		}
	}

	this.addLi = function(t, num) {
		if(!num)	num = 1;

		var o = $(t);
		var li = o.closest("li");
		var ul = li.closest("ul");

		var source   = $("#accordion-form-li").html();
		var template = Handlebars.compile(source);
		var context = {};
		var html    = template(context);

		for(i=0; i<num; i++)
			li.after(html);

		ul.find(".btn-remove").removeClass("hidden");
	}

	this.removeLi = function(t) {
		var o = $(t);
		var li = o.closest("li");
		var ul = li.closest("ul");
		li.remove();

		if(ul.find("li").length == 1)
			ul.find(".btn-remove").addClass("hidden");
	}

	this.footer = function(t, dontAnimate) {
		var o = $(t);
		var f = o.closest(".accordion-group").find(".acc-footer-container");

		if(dontAnimate)
		{
			if(o.prop("checked"))
				f.css("display", "");
			else
				f.css("display", "none");
		}
		else
		{
			if(o.prop("checked"))
				f.slideDown("fast");
			else
				f.slideUp("fast");
		}
	}

	this.generate = function() {
		var data = {fields: [], config: {}};

		$(".accordion-group").each(function() {
			var t = {};
			t.title = $(this).find("[name=title]").val();
			t.open = $(this).find("[name=open]").prop("checked");
			t.type = $(this).find("[name=type]").val() == "text";

			if(t.type)
				t.body = $(this).find("[name=body]").val();
			else
			{
				var list = [];

				$(this).find("li").each(function() {
					list.push($(this).find("input[type=text]").val());
				})

				t.list = list;
			}

			t.hasFooter = $(this).find("[name=hasFooter]").prop("checked");
			t.footer = $(this).find("[name=footer]").val();

			t.index = data.fields.length+1;

			console.log(t);

			data.fields.push(t);
		});

		data.config = {
			addP: $("#addP").prop("checked")
		}

		showOutput({
			data: data,
			template: $("#accordion-html"),
			templateSyntax: $("#accordion-syntax-highlighter"),
			beforeDisplay: function() { $("#generateAccordionBtn").val("Update Accordion Code"); }
		});
	}
}

function Modal() {
	this.init = function() {
	}

	this.addBtn = function(t) {
		var o = $(t);
		var row = o.closest(".btn-row");

		var numButtons = row.closest("ul").find("li").length;

		var source   = $("#modal-form-btn").html();
		var template = Handlebars.compile(source);
		var context = {index: numButtons};
		var html    = template(context);

		if(row.hasClass("gl-add-btn"))
			row.before(html);
		else
			row.after(html);
	}

	this.removeBtn = function(t) {
		var o = $(t);
		var li = o.closest("li");
		var ul = li.closest("ul");
		li.remove();

		if(ul.find("li").length == 1)
			ul.find(".btn-remove").addClass("hidden");
	}

	this.generate = function() {
		var data = {};

		$("#output").slideUp("fast", function() {
			data.modal = {
				title: $("#mod-title").val(),
				body: $("#mod-body").val(),
				size: $("#mod-size").val(),
				fade: $("#fade").prop("checked"),
				btns: []
			};

			//Look for buttons to add to the modal
			$(".btn-row").each(function() {
				//Get past the "global" add row
				if(!$(this).hasClass("gl-add-btn"))
				{
					var a = {};
					/*
					a.text = $(this).find("input[name=btn-text]").val();
					a.class = $(this).find("input[name=btn-class]").val();
					a.href = $(this).find("input[name=btn-href]").val();
					a.click = $(this).find("input[name=btn-click]").val();
					*/
					$(this).find("input[type=text],select").each(function() { a[$(this).prop("name")] = $(this).val(); });
					$(this).find("input[type=checkbox]").each(function() { a[$(this).prop("name")] = $(this).prop("checked"); });
					data.modal.btns.push(a);
				}
			});

			console.log(data);

			data.btn = {
				text: $("#mod-btn-text").val()
			}
		});

		showOutput({
			data: data,
			template: $("#modal-code"),
			templateSyntax: $("#syntax-highlighter"),
			beforeDisplay: function() { $("#generateModBtn").val("Update Modal Code"); }
		});
	}

	this.changeBtnType = function(t) {
		var type = $(t).val();
		var block = $(t).closest("li");

		if(type == "btn")
			block.find(".btn-type-a").slideUp("fast", function() { block.find(".btn-type-btn").slideDown("fast"); })
		else
			block.find(".btn-type-btn").slideUp("fast", function() { block.find(".btn-type-a").slideDown("fast"); })
	}
}


/***
**** GLOBAL
***/
function showOutput(d) {
	$("#output").slideUp("fast", function() {
		//Grab the generated HTML
		var source   = d.template.html();
		var template = Handlebars.compile(source);
		var context = {data: d.data};
		var html    = template(context);

		//Transform the HTML for the syntax highlighter
		var source   = d.templateSyntax.html();
		var template = Handlebars.compile(source);
		var context = {data: html};
		var html_s    = template(context);

		$("#code-container").html(html_s);
		$("#code-container").addClass("code-populated");
		SyntaxHighlighter.highlight();

		$("#preview").html(html);

		if(d.beforeDisplay)
			d.beforeDisplay.call(this);

		//$("#generateAccordionBtn").val("Update Accordion Code");

		$("#output").slideDown("fast", function() { $.scrollTo("#output", 200); });
	});
}

function myTest(a, b) {
	alert(a);
	alert(b);
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

	//http://stackoverflow.com/questions/8853396/logical-operator-in-a-handlebars-js-if-conditional
	Handlebars.registerHelper('ifCond', function(v1, v2, options) {
	  if(v1 === v2) {
	    return options.fn(this);
	  }
	  return options.inverse(this);
	});
}


$(function() {
	handlebarsInit();
	//SyntaxHighlighter.all()
});

var accordion = new Accordion();
var modal = new Modal();