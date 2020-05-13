jQuery(function($) {
  $(document).ready(function() {

    // smooth scroll anchor #
		$('a[href^="#"]').bind('click.smoothscroll', function(e) {
			$target = $(this.hash);
			e.preventDefault();
	
      $('html, body').stop().animate({
        'scrollTop': $target.offset().top
          }, 600, 'swing', function() {
      });
    });
    
  })


})