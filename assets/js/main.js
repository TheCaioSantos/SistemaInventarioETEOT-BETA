$.noConflict();

jQuery(document).ready(function ($) {

	"use strict";

	[].slice.call(document.querySelectorAll('select.cs-select')).forEach(function (el) {
		new SelectFx(el);
	});

	jQuery('.selectpicker').selectpicker;




	$('.search-trigger').on('click', function (event) {
		event.preventDefault();
		event.stopPropagation();
		$('.search-trigger').parent('.header-left').addClass('open');
	});

	$('.search-close').on('click', function (event) {
		event.preventDefault();
		event.stopPropagation();
		$('.search-trigger').parent('.header-left').removeClass('open');
	});

	$('.equal-height').matchHeight({
		property: 'max-height'
	});

	// var chartsheight = $('.flotRealtime2').height();
	// $('.traffic-chart').css('height', chartsheight-122);


	// Counter Number
	$('.count').each(function () {
		$(this).prop('Counter', 0).animate({
			Counter: $(this).text()
		}, {
				duration: 3000,
				easing: 'swing',
				step: function (now) {
					$(this).text(Math.ceil(now));
				}
			});
	});




	// Menu Trigger
	$('#menuToggle').on('click', function (event) {
		var windowWidth = $(window).width();
		if (windowWidth < 1010) {
			$('body').removeClass('open');
			if (windowWidth < 760) {
				$('#left-panel').slideToggle();
			} else {
				$('#left-panel').toggleClass('open-menu');
			}
		} else {
			$('body').toggleClass('open');
			$('#left-panel').removeClass('open-menu');
		}

	});


	$(".menu-item-has-children.dropdown").each(function () {
		$(this).on('click', function () {
			var $temp_text = $(this).children('.dropdown-toggle').html();
        if ($(this).children('.sub-menu').children('.subtitle').length == 0)
			$(this).children('.sub-menu').prepend('<li class="subtitle">' + $temp_text + '</li>');
		});
	});


	// Load Resize 
	$(window).on("load resize", function (event) {
		var windowWidth = $(window).width();
		if (windowWidth < 1010) {
			$('body').addClass('small-device');
		} else {
			$('body').removeClass('small-device');
		}

	});

	/*
	$('select#cod-class-titulo').change(function () {
		var value = $(this).val();
		$.get('controller/bens.php?nr_titulo=' + value, [], function (data) {
			for (var i = 0; i < data.length; i++) {
				alert(data[i][4]);
			}
		}, 'json');
	});
	*/
	
	$('#cod-class-titulo').on("change",function(){
		var codClass = $('#cod-class-titulo').val()
		$.ajax({
			url: 'controller/cod_class.php',
			type: 'POST',
			dataType: 'json',
			data: {cod:codClass},
			beforeSend: function(){
				$('#codclass-subtitulo').css({'display':'block'});
				$('#codclass-subtitulo').html("carregando...");
			},
			success: function(data)
			{
				var html = '<option value="">Selecione uma classificação...</option>';	
				for (var i = 0; i < data.length; i++) {
					html += '<option value="' + data[i][0] + '">' + data[i][3] + ' - ' + data[i][4] + '</option>';
				}

				$('#codclass-subtitulo').html(html);
				//$('#codclass-subtitulo').css({'display':'block'});
				//$('#codclass-subtitulo').css(data);
			},
			error: function(data)
			{
				$('#codclass-subtitulo').css({'display':'block'});
				$('#codclass-subtitulo').css("Houve um erro ao carregar.");
			}
		});

	});



	

});