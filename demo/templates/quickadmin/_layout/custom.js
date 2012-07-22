

	$(window).resize(function(){
		
		//### Rebuild charts on resize
		//###
				
		init_charts();
	
	});
	

	$(function(){

		init_tables();
		
		init_charts();
		
		init_panels();
		
		init_wysiwyg();
		
		init_forms();
		
		init_calendar();
		
		init_gallery();
		
		init_sideNavigation();
		
		init_logoHover();
		
		init_faq();
		
		init_notices();
		
	});

	
	function init_notices(){

		$('.notice').click(function(){
			$(this).slideUp('fast');
		})
		
	}
	

	function init_faq(){
		
		if ($('#faq-list').size()){
		
			var options = {  valueNames: [ 'name' ] };
			var faqList = new List('faq-list', options);
			
		}
		
	}
	
	
	function init_logoHover(){
		$(".logo").hover(function(){
			$(this).animate({opacity:0.6},'fast');
		},function(){
			$(this).animate({opacity:1},'fast');
		});
	}
	
	
	function init_gallery(){
	
		if ($('.content-gallery').size()){
		
		
			$('.content-gallery li').hover(function(){
				$('div', this).fadeIn('fast');
			}, function(){
				$('div', this).fadeOut('fast');
			});
		
		
			$(".content-gallery div a").colorbox();
		
		
		}
				
	}
	
		
	function init_sideNavigation(){
		
		$("#navigation > li > a").click(function(){
			var parent = $(this).closest('li');
			
			if ($('ul',parent).size()){
			
				if ($(parent).hasClass('active')){
					$('ul',parent).slideUp('fast',function(){
						$(parent).removeClass('active');
					});
				}else{
					$('ul',parent).slideDown('fast');
					$(parent).addClass('active');
				}
				
				return false;
			}		
		});

	}
	
		
	function init_calendar(){
	
		var date = new Date();
		var d = date.getDate();
		var m = date.getMonth();
		var y = date.getFullYear(); 
	
		if ($('#sample-calendar').size() == 0){
			return false;
		}
	
		 $('#sample-calendar').fullCalendar({ 
			header: {
						left: 'title',
						center: 'month,basicWeek,basicDay',
						right: 'prev,next'
					},
			editable: true,
			events: [
				{
					title: 'All Day Event',
					start: new Date(y, m, 1)
				},
				{
					title: 'Long Event',
					start: new Date(y, m, d-5),
					end: new Date(y, m, d-2)
				},
				{
					id: 999,
					title: 'Repeating Event',
					start: new Date(y, m, d-3, 16, 0),
					allDay: false
				},
				{
					id: 999,
					title: 'Repeating Event',
					start: new Date(y, m, d+4, 16, 0),
					allDay: false
				},
				{
					title: 'Meeting',
					start: new Date(y, m, d, 10, 30),
					allDay: false
				},
				{
					title: 'Lunch',
					start: new Date(y, m, d, 12, 0),
					end: new Date(y, m, d, 14, 0),
					allDay: false
				},
				{
					title: 'Birthday Party',
					start: new Date(y, m, d+1, 19, 0),
					end: new Date(y, m, d+1, 22, 30),
					allDay: false
				},
				{
					title: 'Click for Google',
					start: new Date(y, m, 28),
					end: new Date(y, m, 29),
					url: 'http://google.com/'
				}
			]

		 });
		 
	}
	
	
	function init_forms(){ 
	
		if($("select, input:checkbox, input:radio, input:file").size()){
			$("select, input:checkbox, input:radio, input:file").uniform();
		}
		
		$("form .submit").click(function(){
			$(this).closest('form').submit(); 
		});
	}
	
	
	function init_wysiwyg() {
		
		$('textarea.wysiwyg-editor').each(function(){
			
			var editor_id = $(this).attr('id');
			new nicEditor({iconsPath : '_layout/scripts/nicEdit/nicEditorIcons.gif'}).panelInstance(editor_id); 
			
		});
		
	}
	
	
	function init_panels() {
		
		$('.panel .collapse').click(function(){
			if ($(this).closest('.panel').hasClass('collapsed')){
				var restoreHeight = $(this).attr('id');
				
				$(this).closest('.panel').animate({height:restoreHeight+'px'}, function() {   
					$(this).removeClass('collapsed');
				});
				
			}else{
				var currentHeight = $(this).closest('.panel').height();
				
				$(this).attr('id', currentHeight);
				$(this).closest('.panel').addClass('collapsed').animate({height:'45px'}, function(){		});
			}
		}); 
		
		$('.panel .tabs li').click(function(){
			var parent = $(this).closest('.panel');
			var content = $('a', this).attr('rel');
			
			$('.tabs .active', parent).removeClass('active');
			$(this).addClass('active');
			
			$('.tabs-content > .active', parent).slideUp('fast', function(){
				$(this).removeClass('active');
				
				$('#'+content).slideDown('fast', function(){
					$(this).addClass('active');
				});
			});
			
			return false;
		});
		
	}
	
	
	function init_tables() {

		if ($('table.sortable').size()){
			$("table.sortable").tablesorter(); 
		}
		
		if ($('table.resizable').size()){
			
		}	
	}
	
	
	function init_charts() {
	
		if ($('.graph').size() == 0){
			return false;
		}
	
		
		Morris.Line({
		  element: 'raphael-graph-years',
		  data: [
			{y: '2012', a: 100},
			{y: '2011', a: 75},
			{y: '2010', a: 50},
			{y: '2009', a: 75},
			{y: '2008', a: 50},
			{y: '2007', a: 75},
			{y: '2006', a: 100},
			{y: '2005', a: 34},
			{y: '2004', a: 24},
			{y: '2003', a: 62},
			{y: '2002', a: 22}
		  ],
		  xkey: 'y',
		  ykeys: ['a'],
		  labels: ['Series A'],
		  lineColors: ['#f86638']
		});
	
	
		if (typeof($.plot) != 'function'){ 
			log('*** Error - Flot javascript required files not loaded');
			
			return false;
		} 
	
	
		var data = [];
		var series = Math.floor(Math.random()*4)+3;

		for( var i = 0; i<series; i++){
			data[i] = { label: "Series"+(i+1), data: Math.floor(Math.random()*100)+1 }
		}
	
		
		$.plot($("#flot-pie-square"), data, {

			series: {
				pie: { 
					show: true,
					radius: 0.85,
					label: {
						show: true,
						radius: 2/3,
						formatter: function(label, series){
							return '<div style="font-size:8pt;text-align:center;padding:2px;color:white;">'+label+'<br/>'+Math.round(series.percent)+'%</div>';
						},
						threshold: 0.1
					}
				}
			},

			legend: {
				show: false
			}
		});



		$.plot($("#flot-donut"), data, {
			series: {
				pie: { 
					innerRadius: 0.3,
					show: true
				}
			},
			legend: {
				show:false
			}
		});

		$.plot($("#flot-pie-normal"), data, {
			series: {
				pie: { 
					show: true
				}
			},
			legend: {
				show:false
			},

			grid: {
				hoverable: true,
				clickable: true
			}
		});

		//$("#flot-pie-normal").bind("plothover", pieHover);
		//$("#flot-pie-normal").bind("plotclick", pieClick);
	
	}
	
	
	function pieHover(event, pos, obj){
		if (!obj) return;
		percent = parseFloat(obj.series.percent).toFixed(2);

		$("#hover").html('<span style="font-weight: bold; color: '+obj.series.color+'">'+obj.series.label+' ('+percent+'%)</span>');
	}
	
 
	function pieClick(event, pos, obj){
		if (!obj) return;

		percent = parseFloat(obj.series.percent).toFixed(2);
		alert(''+obj.series.label+': '+percent+'%');
	}

	
	function log(message){
		//console.log(message);
	}