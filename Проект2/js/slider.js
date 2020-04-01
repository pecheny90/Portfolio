let slider = $('.slider-block');
let sliderContainer = $('.slider-container');
let activeClass = 'round-active';
let slides = $('.slides');
let slideSelector = $('.slider-point');
let slideWidth = slider.width() + 'px';
let total = slides.length;
let round = [];


for (let i=0; i<total; i++){
	slides.eq(i).css({minWidth: slideWidth});
	slideSelector.append('<div class="round"></div>');
	let point = $('.round').eq(i);
	point.attr('data-id', i);
	
	if ( i===0 ) {
		point.addClass(activeClass);
		let heightFirst = slider.eq(0).innerHeight() + 'px';
		slider.animate({height: heightFirst}, 500);
	}
	
	point.on('click', function() {
		let pointId = $(this).attr('data-id');
		let height = slides.eq(pointId).height() + 'px';
		let offset = pointId * -100 + '%';
		sliderContainer.animate({'left': offset, height: height}, 500);
		slider.animate({height: height}, 500);
		round.removeClass(activeClass);
		$(this).addClass(activeClass);
		
	});
}

round = $('.round');
















