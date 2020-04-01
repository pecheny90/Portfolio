$('.filter-item__label_fold').click(
    function() { 
        $('.option-one').slideToggle();
        $('.filter-item__label_fold').toggleClass('upside-down');
    }
);

$('.filter-item__label_two').click(
    function() { 
        $('.option-two').slideToggle();
        $('.filter-item__label_two').toggleClass('upside-down');
    }
);

$('.filter-item__label_three').click(
    function() { 
        $('.option-three').slideToggle();
        $('.filter-item__label_three').toggleClass('upside-down');
    }
);
