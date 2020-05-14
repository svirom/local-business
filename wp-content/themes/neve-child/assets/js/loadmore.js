jQuery(function($) {
  $(document).ready(function(){

    $('#true_loadmore').click(function(e){
      e.preventDefault();
      $(this).html('<a href="#" class="rotate-icon"></a>');

      var data = {
        'action': 'loadmore',
        'query': true_posts,
        'page' : current_page,
      };

      $.ajax({
        url:ajaxurl, 
        data:data, 
        type:'POST',
        success:function(data){
          if( data ) {
            $('#true_loadmore').html('<a href="#" class="btn btn-link">Показати ще</a>').before(data);
            current_page++;
            if (current_page == max_pages) $("#true_loadmore").remove();
          } else {
            $('#true_loadmore').remove();
          }
        }
      });
    });


  });

});