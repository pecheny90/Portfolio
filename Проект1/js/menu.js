$('.mobile-menu-button').click(function(){
    if ( $(this).hasClass('mobile-menu-visible') ) {
        // Убираем мобильное меню
        $('.popup-menu').animate(
         {
             'top': -250
         },
        1500
     );

    } else {
        // показываем мобильное меню
	$('.popup-menu').animate(
         {
             'top': 0
         },
        1500
     );

    }
    $(this).toggleClass('mobile-menu-visible');
});