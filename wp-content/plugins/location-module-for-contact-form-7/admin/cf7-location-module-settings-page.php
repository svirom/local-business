<?php
/**
 *  Location Module (LITE) for Contact Form 7
 *
 *  Option Init, Validate, Page
 */
?>
    <div class="wrap">
        <h2><strong>Location Module</strong>(LITE) for Contact Form 7</h2>
        <form method="post" action="options.php">
            <?php settings_fields( 'cf7_location_module-settings-group' ); ?>
            <?php do_settings_sections( 'cf7_location_module-settings-group' ); ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row"><?php echo __('Start Location','location-module-for-contact-form-7'); ?><br><?php echo __('Latitude / Longitude','location-module-for-contact-form-7'); ?></th>
                    <td><input type="text" name="default_lat" value="<?php echo esc_attr( get_option('default_lat','41.9102415') ); ?>" />
                        <input type="text" name="default_lng" value="<?php echo esc_attr( get_option('default_lng','12.3959126') ); ?>" />
                    </td>
                    <span><?php echo __('You can use this tool to get the coordinates for your start location','location-module-for-contact-form-7'); ?>&nbsp;<?php echo __('<a href="http://itouchmap.com/latlong.html" target="_blank" alt="itouchmap.com">itouchmap</a>','location-module-for-contact-form-7'); ?></span>
                </tr>
                <tr>
                    <th scope="row"><?php echo __('Show Marker on Start Location','location-module-for-contact-form-7'); ?></th>
                    <td>
                        <input type="checkbox" name="cf7_mrkr_enable" id="cf7_mrkr_enable" <?php checked('true', get_option('cf7_mrkr_enable'));?> value="true">
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php echo __('Start Zoom Level','location-module-for-contact-form-7'); ?></th>
                    <td><input type="text" name="default_zoom" value="<?php echo esc_attr( get_option('default_zoom','10') ); ?>" /></td>
                </tr>
                <tr>
                    <th scope="row"><?php echo __('Google Maps API key:','location-module-for-contact-form-7'); ?></th>
                    <td><input type="text" name="default_api_key" value="<?php echo esc_attr( get_option('default_api_key','') ); ?>" /> <?php echo __('To get an API Key please <a href="https://developers.google.com/maps/documentation/javascript/get-api-key#key" target="_blank">check this','location-module-for-contact-form-7');?></a></td>
                </tr>
                <tr>
                    <th scope="row"><?php echo __('Google Maps View','location-module-for-contact-form-7'); ?></th>
                    <td>
                        <select name="mapsView" type="text">
                            <option value="roadmap" <?php if(get_option('mapsView','roadmap') == 'roadmap'){echo 'selected="selected"';}?>>Roads </option>
                            <option value="satellite" <?php if(get_option('mapsView','roadmap') == 'satellite'){echo 'selected="selected"';}?>>Satellite </option>
                            <option value="hybrid" <?php if(get_option('mapsView','roadmap') == 'hybrid'){echo 'selected="selected"';}?>>Hybrid </option>
                            <option value="terrain" <?php if(get_option('mapsView','roadmap') == 'terrain'){echo 'selected="selected"';}?>>Terrain</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><?php echo __('Enable Reset Button','location-module-for-contact-form-7'); ?></th>
                    <td>
                        <input type="checkbox" name="cf7_enable_reset" id="cf7_enable_reset" <?php checked('true', get_option('cf7_enable_reset'));?> value="true">
                    </td>
                </tr>
                <tr>
                    <th scope="row"><?php echo __('Enable GPS Acquire Button','location-module-for-contact-form-7'); ?></th>
                    <td>
                        <input type="checkbox" name="cf7_gps_enable" id="cf7_gps_enable" <?php checked('true', get_option('cf7_gps_enable'));?> value="true">
                    </td>
                </tr>
                <tr>
                    <th scope="row"><?php echo __('Custom Button Text','location-module-for-contact-form-7'); ?></th>
                    <td>
                        <input type="text" name="cf7_custom_button_text" id="cf7_custom_button_text" value="<?php echo esc_attr( get_option('cf7_custom_button_text','') ); ?>">
                    </td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
<?php
