<?php

global $curr_lang;

if ( $curr_lang == 'uk' ) {
  $image = '/assets/img/hand-ua.png';
  $add_place = '/add-place';
} else if ( $curr_lang == 'ru' ) {
  $image = '/assets/img/hand-ru.png';
  $add_place = '/ru/add-place';
} else if ( $curr_lang == 'en' ) {
  $image = '/assets/img/hand-en.png';
  $add_place = '/en/add-place';
} else {
  $image = '/assets/img/hand-empty.png';
  $add_place = '/add-place';
}

?>

<div class="row header-home-wrapper">
  <div class="col-12 container-home">
    <div class="row">
      <div class="col-md-7">
        <div class="header-home">
          <h1><?php echo __('Підтримай місцевий бізнес', 'neve-child'); ?></h1>
          <p><?php echo __('Шукайте на карті улюблені заклади поруч з вами та дізнавайтеся як їх можна підтримати: замовити доставку або ж придбати онлайн сертифікат, який пізніше можна буде обміняти на товари та послуги.', 'neve-child'); ?></p>
          <div class="header-home-buttons">
            <a href="#map-title" class="btn btn-primary btn-hash"><?php echo __('Подивитись на мапі', 'neve-child'); ?></a>
            <a href="<?php echo site_url() . $add_place; ?>" class="btn btn-link"><?php echo __('Додати свій заклад', 'neve-child'); ?></a>
          </div>
        </div>
      </div>
      <div class="col-md-5 header-img">
        <img src="<?php echo get_stylesheet_directory_uri() . $image; ?>" alt="">
      </div>
    </div>
  </div>
</div>

