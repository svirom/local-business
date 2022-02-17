jQuery(function($) {
  $(document).ready(function(){

    var currLang = $('html').attr('lang');
    var addMore;
    
    if (currLang === 'ru-RU') {
      addMore = '<a href="#" class="btn btn-link">Показать еще</a>';
    } else if (currLang === 'en-US') {
      addMore = '<a href="#" class="btn btn-link">Show more</a>';
    } else {
      addMore = '<a href="#" class="btn btn-link">Показати ще</a>';
    }

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
            $('#true_loadmore').html(addMore).before(data);
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