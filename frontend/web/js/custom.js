var notMobile = (!(navigator.userAgent.match(/Android/i)
	 || navigator.userAgent.match(/webOS/i)
	 || navigator.userAgent.match(/iPhone/i)
	 || navigator.userAgent.match(/iPad/i)
	 || navigator.userAgent.match(/iPod/i)
	 || navigator.userAgent.match(/BlackBerry/i)
	 || navigator.userAgent.match(/Windows Phone/i)
	 )) ? true : false;

function initTinyScroll(){
	if (notMobile) {
		$tiny = $('.scroll-block');
		if ($tiny.length) {
			$tiny.tinyscrollbar();
			console.log('Tinyscrollbar init');
			window.tiny = $tiny.data("plugin_tinyscrollbar");
			return window.tiny;
		}
	}
	return false;
}
function initIsotope($tiny){
	$isotope = $('.isotope');
	if ($isotope.length) {
		$isotope.isotope({itemSelector: '.iso-item',layoutMode: 'packery',});
		console.log('Isotope init');
		$isotope.on('arrangeComplete', function() {
			console.log('Arrange complete');
			var tiny = initTinyScroll();
			if (tiny) {
				$isotope.on('layoutComplete', function() {
					tiny.update("relative");
					console.log('Tinyscrollbar update');
				});
			}
			if ($('#preloader').length) {
				$('#preloader').fadeOut(200);
			}
		});
		if ($('#preloader').length) {
			setTimeout(function(){
				$isotope.isotope('arrange');
			}, 3000);
		} else {
			$isotope.isotope('arrange');
		}
	} else {
		setTimeout(function(){
			initTinyScroll();
		}, 200);
	}
}
function initFilmRoll($w) {
	if ($w.width() > 900) {
		if (!$('#filmRollClone').length) {
			var clone = $("#filmRoll").addClass('hide').clone().insertAfter("#filmRoll");
			clone.attr('id', 'filmRollClone').removeClass('hide');
			new FilmRoll({
				container: '#filmRollClone',
				height: 600,
				pager: false,
				scroll: false,
			});
			console.log('FilmRoll init');
		}
		$('.container').height($w.height() - $('.navbar').height());
	} else {
		if ($('#filmRollClone').length) {
			$('#filmRollClone').remove();
			console.log('FilmRoll destroy');
		}
		$("#filmRoll").removeClass('hide');
		$('.container').height('auto');
	}
}
function initPlugins(){
	var autosize = $('textarea.autosize');
	var colorpicker = $('.color-picker');
	var selectpicker = $('.selectpicker');
	if (autosize.length) {
		$('textarea.autosize').autosize();
		console.log('autosize init');
	}
	if (colorpicker.length) {
		colorpicker.colorpicker({
			'format':'hex',
			'horizontal':true,
			slidersHorz: {
				saturation: {
					maxLeft: 230,
					maxTop: 230
				},
				hue: {
					maxLeft: 230
				}
			}
		}).on('changeColor', function(e){
			var target = $(e.target),
				targetId = target.attr('data-input'),
				colorRGB = e.color.toRGB();
			$(targetId + '_r').val(colorRGB.r);
			$(targetId + '_g').val(colorRGB.g);
			$(targetId + '_b').val(colorRGB.b);
		});
		$('.rgb-input').mask('999', {onKeyPress: function(cep, e, field){
			if (cep>255 || cep<0) {
				field.val(field.attr('data-val'));
			} else {
				field.attr('data-val', cep);
			}
		}});
		$('.rgb-input').change(function(){
			var self = $(this),
				name = self.attr('name'),
				input = $('input[name="' + name + '"]'),
				r = input.filter('#' + name + '_r').val(),
				g = input.filter('#' + name + '_g').val(),
				b = input.filter('#' + name + '_b').val(),
				color = 'rgb(' + (r ? r : 0) + ',' + (g ? g : 0) + ',' + (b ? b : 0) + ')';

			self.closest('.color-picker').colorpicker('setValue', color);
		});
		console.log('colorpicker init');
	}
	if (selectpicker.length) {
		selectpicker.selectpicker('refresh');
		console.log('selectpicker init');
		selectpicker.on('changed.bs.select', function (e, s) {
			var $self = $(e.target),
				style = $.parseJSON($self.find('option').eq(s).attr('data-style')),
				$styleBlock = $($self.attr('data-target-style')),
				$styleLabel = $styleBlock.find('label'),
				$styleInput = $styleBlock.find('input');

			$styleBlock.siblings('.dropdown-toggle').find('.default-addon span').empty();
			$styleLabel.hide().removeClass('active');
			$styleInput.attr('disabled','disabled').removeAttr('checked');
			for (var i in style) {
				$styleLabel.filter('.' + style[i]).show();
				$styleInput.filter('[value="' + style[i] + '"]').removeAttr('disabled');
			}
		});
	}
}
$(document).ready(function(){
	$(document).on('click', '.navbar-toggle', function(){
		self = $(this);
		((self.hasClass('active')) ? self.removeClass('active') : self.addClass('active'));
		$('.scroll-block').unbind("tinyscrollbar");
	});
	if (notMobile) {
		$tiny = $('.scroll-block');
		if ($tiny.length) {
			$tiny.html('<div class="scrollbar"><div class="track"><div class="thumb"><div class="end"></div></div></div></div><div class="viewport"><div class="overview">' + $tiny.html() + '</div></div>');
		}
	} else {
		$('body').css('overflow','scroll');
	}
	var $fullpage = $('#fullpage'),
		$w = $(window);
	if ($fullpage.length) {
		$fullpage.fullpage({
			verticalCentered: false,
			slidesNavigation: true,
			navigation: true,
			navigationPosition: 'right',
			afterRender: function(){
				if ($fullpage.find('.section').length <= 1) {
					$('#fp-nav').hide();
				}
			}
		});
		$('.fp-controlArrow.vertical.fp-prev').click(function(){
			$.fn.fullpage.moveSectionUp();
		});
		$('.fp-controlArrow.vertical.fp-next').click(function(){
			$.fn.fullpage.moveSectionDown();
		});
	}
	if ($("#filmRoll").length) {
		initFilmRoll($w);
		$w.resize(function(){
			initFilmRoll($w);
		});
	}
	initIsotope();
	initPlugins();
});