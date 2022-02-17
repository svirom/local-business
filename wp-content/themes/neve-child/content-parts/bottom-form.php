<?php 
global $curr_lang;

if ( $curr_lang == 'ru' ) {
  $add_place = '/ru/add-place';
} else if ( $curr_lang == 'en' ) {
  $add_place = '/en/add-place';
} else {
  $add_place = '/add-place';
}

?>

<div class="row bottom-form-wrapper">
  <div class="col-12 container-home text-center">
    <div class="bottom-form">
      <h2 class="bottom-form-title"><?php echo __('Додайте свій бізнес до нашого каталогу', 'neve-child'); ?></h2>
      <p class="bottom-form-text"><?php echo __('Розмістіть свій заклад на нашу мапу та отримайте додаткову можливість клієнтам дізнатися про ваші пропозиції.', 'neve-child'); ?></p>
      <div class="bottom-form-button">
        <a href="<?php echo site_url() . $add_place; ?>" class="btn btn-primary"><?php echo __('Заповнити анкету', 'neve-child'); ?></a>
      </div>
    </div>
  </div>
</div>

