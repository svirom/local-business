<?php

class LMCF7_Options {

    public function __construct() {
    }

    public function load_admin_options_hooks(){
        add_action('admin_menu', array($this,'cf7_location_module_create_menu'));
        add_action( 'admin_init', array($this,'register_cf7_location_module_settings'));
    }

    public function cf7_location_module_create_menu() {

        //create new sub menu
        add_options_page('Location Module (LITE) for Contact Form 7', 'Location Module for CF7', 'administrator','cf7-location-module-settings', array($this,'cf7_location_module_settings_page') , plugins_url('/images/icon.png', __FILE__) );

    }

    public function register_cf7_location_module_settings() {
        //register our settings
        register_setting( 'cf7_location_module-settings-group', 'default_lat',array($this,'lat_validation'));           // Default Latitude
        register_setting( 'cf7_location_module-settings-group', 'default_lng',array($this,'lng_validation' ));           // Default Longitude
        register_setting( 'cf7_location_module-settings-group', 'default_zoom',array($this,'zoom_validation' ));         // Default Zoom
        register_setting( 'cf7_location_module-settings-group', 'default_api_key',array($this,'maps_api_validation' ));  // Default API KEY Google Maps
        register_setting( 'cf7_location_module-settings-group', 'mapsView',array($this,'mapType_validation' ));          // Map Type
        register_setting( 'cf7_location_module-settings-group', 'cf7_enable_reset',array($this,'checkbox_validation' )); // Enable Reset Button
        register_setting( 'cf7_location_module-settings-group', 'cf7_custom_button_text', array($this,'cf7_set_button_text_validation' )); // Enable Reset Button
        register_setting( 'cf7_location_module-settings-group', 'cf7_mrkr_enable',array($this,'checkbox_validation' ));  // cf7_mrkr_enable
        register_setting( 'cf7_location_module-settings-group', 'cf7_gps_enable',array($this,'checkbox_validation' ));  // cf7_gps_enable
    }

    public function lat_validation($input) {
        if (preg_match('/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/', $input)){

            return $input;
        }
        add_settings_error( '', '', __('Latitude Invalid','location-module-for-contact-form-7'), 'error' );

        return '';
    }

    public function lng_validation($input){

        if (preg_match('/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/', $input)){

            return $input;
        }

        add_settings_error( '', '', __('Longitude Invalid','location-module-for-contact-form-7'), 'error' );
        return '';
    }

    public function zoom_validation($input){

        if(('0' <= $input) && ($input <= '15') ){

            return $input;
        }
        add_settings_error( '', '', __('Zoom Invalid, must be between 1 and 15','location-module-for-contact-form-7'), 'error' );
        return '1';
    }

    public function maps_api_validation($input){

        if (preg_match('/[\'^*()}{~?><>,|=+¬]/', $input)){
            add_settings_error( '', '', __('API KEY INVALID','location-module-for-contact-form-7'), 'error' );
            return '';
        }else{
            return $input;
        }
    }

    public function mapType_validation($input) {
        if ($input =='roadmap' ){
            return $input;
        }elseif($input =='satellite'){
            return $input;
        }elseif($input =='hybrid'){
            return $input;
        }elseif($input =='terrain'){
            return $input;
        }

        add_settings_error( '', '', __('Map Type Invalid','location-module-for-contact-form-7'), 'error' );

        return '';
    }

    public function checkbox_validation($input){
        return $input;
    }

    public function cf7_set_button_text_validation($input){
        return $input;
    }

    public function cf7_location_module_settings_page(){
        require_once dirname(plugin_dir_path(__FILE__)).'/admin/cf7-location-module-settings-page.php';
    }
}