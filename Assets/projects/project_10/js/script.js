/* STEP 2a - DOM ready*/
$(function(){
/* STEP 2b - script to add class to nav when header is scrolled off screen */
// Persistent navigation
//add additional necessary offset for Webkit
var navTop = $(floatingbar).offset().top;
// Scroll function
$(window).scroll(function() {
    // Once window has scrolled past top of nav, add class .floater
    if($(window).scrollTop() > navTop) {
        // add class .floater
        $('#floatingbar').addClass('floater');
        // add class to the header > h1
        $('header>h1').addClass('floater-h1');
    } else {
        // remove class .floater
        $('#floatingbar').removeClass('floater');
        // remove class to the header > h1
        $('header>h1').removeClass('floater-h1');
    }

    if($(window).scrollTop() > navTop*2) {
        // show the back to top button
        $('footer p a.top').fadeIn(200);
    } else {
        // hide the back to top button
        $('footer p a.top').fadeOut(200);
    }
});

/* STEP 6e - click handler to animate scroll to top */
$('footer p a.top').click(function(event) {
    /* stop default anchor behavior */
    event.preventDefault();
    // animate the whole page up the scroll top over X milliseconds
    $('html, body').animate({scrollTop: 0}, 300);
});
    
/* STEP 3 - script to duplicate pullquote text */
// Pullquotes
$('span.pullquote').each(function() {
    // grab the parent element (paragraph)
    var $parentElem = $(this).parent('p');
    // clone the span element inside it, add special class for css, and inject it into the html
    $(this).clone().addClass('pullquote2').prependTo($parentElem);
});
});
// end DOM ready