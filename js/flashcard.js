// flashcard.js


$(function() { // start of the jQuery wrapper
	
$('.flip-container').hide();
$('.flip-container').eq(0).show();

var visiblecard = 0;

$('.next').click(function() {
	
	visiblecard++;
	$('.flip-container').hide();
	$('.flip-container').eq(visiblecard).show();


});

$('.previous').click(function() {
	
	visiblecard--;
	$('.flip-container').hide();
	$('.flip-container').eq(visiblecard).show();
});

}); // end of the jQuery wrapper


