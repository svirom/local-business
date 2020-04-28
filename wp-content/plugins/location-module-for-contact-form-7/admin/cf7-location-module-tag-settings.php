<?php
/**
 *  Location Module (LITE) for Contact Form 7
 *
 *  Module Template
 */
defined( 'ABSPATH' ) or die( 'Ops!' );
?>
<div class="control-box">
        <fieldset>
            <legend><?php printf( esc_html( $description ), $desc_link ); ?></legend>

<table class="form-table">
    <tbody>
    <tr>
        <th scope="row"><?php echo esc_html( __( 'Field type', 'contact-form-7' ) ); ?></th>
        <td>
            <fieldset>
                <legend class="screen-reader-text"><?php echo esc_html( __( 'Field type', 'location-module-for-contact-form-7' ) ); ?></legend>
                <label><input type="checkbox" name="required" /> <?php echo esc_html( __( 'Required field', 'location-module-for-contact-form-7' ) ); ?></label>
            </fieldset>
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="<?php echo esc_attr( $args['content'] . '-name' ); ?>"><?php echo esc_html( __( 'Name', 'location-module-for-contact-form-7' ) ); ?></label></th>
        <td><input type="text" name="name" class="tg-name oneline" id="<?php echo esc_attr( $args['content'] . '-name' ); ?>" /></td>
    </tr>
    <tr>
        <th scope="row"><label for="<?php echo esc_attr( $args['content'] . '-class' ); ?>"><?php echo esc_html( __( 'Class (optional)', 'location-module-for-contact-form-7' ) ); ?></label></th>
        <td><input type="text" name="class" class="classvalue oneline option" id="<?php echo esc_attr( $args['content'] . '-class' ); ?>" /></td>
    </tr>
    <tr>
        <th scope="row"><label for="<?php echo esc_attr( $args['content'] . '-values' ); ?>"><?php echo esc_html( __( 'Placeholder(optional)', 'location-module-for-contact-form-7' ) ); ?></label></th>
        <td><input type="text" name="values" class="oneline" id="<?php echo esc_attr( $args['content'] . '-values' ); ?>" /><br />
    </tr>
    <tr>
        <th scope="row"></th>
        <td><strong><?php echo __('Now you can use this tags on Mail Section:','location-module-for-contact-form-7') ?></strong>
        <ul>
            <li>[cf7-location-lng] = <?php echo __('Location longitude','location-module-for-contact-form-7') ?></li>
            <li>[cf7-location-lat] = <?php echo __('Location latitude','location-module-for-contact-form-7') ?></li>
            <li>[cf7-location-url] = <?php echo __('Google Maps Link with marker','location-module-for-contact-form-7') ?></li>
        </ul>
        </td>
    </tr>
    </tbody>
</table>
</fieldset>
</div>
<div class="insert-box">
    <input type="text" name="location" class="tag code" readonly="readonly" onfocus="this.select()" />

    <div class="submitbox">
        <input type="button" class="button button-primary insert-tag" value="<?php echo esc_attr( __( 'Insert Tag', 'location-module-for-contact-form-7' ) ); ?>" />
    </div>

    <br class="clear" />

    <p class="description mail-tag"><label for="<?php echo esc_attr( $args['content'] . '-mailtag' ); ?>"><?php echo sprintf( esc_html( __( "To use the value input through this field in a mail field, you need to insert the corresponding mail-tag (%s) into the field on the Mail tab.", 'location-module-for-contact-form-7' ) ), '<strong><span class="mail-tag"></span></strong>' ); ?><input type="text" class="mail-tag code hidden" readonly="readonly" id="<?php echo esc_attr( $args['content'] . '-mailtag' ); ?>" /></label></p>
</div>