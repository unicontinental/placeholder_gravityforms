<?php
/*
Plugin Name: Gravity Forms Placeholders
Plugin URI: http://oc.continental.edu.pe
Description: Enable placeholders in Gravity Forms
Version: 0.1
Author: Oficina de Comunicaciones de la Corporación Educativa continental
Author URI: http://oc.continental.edu.pe
Instructions: Active plugin.
*/

if (class_exists('GFForms')) {
    add_filter( 'gform_enable_field_label_visibility_settings', '__return_true' );
}

