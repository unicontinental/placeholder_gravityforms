<?php
/*
Plugin Name: Enable Placeholders, Tabindex Conflicts
Plugin URI: https://github.com/unicontinental/placeholder_gravityforms
Description: Enable placeholders in Gravity Forms and Fix Gravity Form Tabindex Conflicts
Version: 0.2.0.1
Author: Oficina de Comunicaciones de la Corporación Educativa Continental
Author URI: https://github.com/unicontinental/placeholder_gravityforms
Instructions: Active plugin.
*/

if (class_exists('GFForms')) {
	/**
	* Enable Gravity Forms Placeholders
	*/
	add_filter( 'gform_enable_field_label_visibility_settings', '__return_true' );

	/**
	 * Fix Gravity Form Tabindex Conflicts
	 * https://gravitywiz.com/fix-gravity-form-tabindex-conflicts/
	 */
	add_filter( 'gform_tabindex', 'gform_tabindexer', 10, 2 );
	function gform_tabindexer( $tab_index, $form = false ) {
	    $starting_index = 1000; // if you need a higher tabindex, update this number
	    if( $form )
	        add_filter( 'gform_tabindex_' . $form['id'], 'gform_tabindexer' );
	    return GFCommon::$tab_index >= $starting_index ? GFCommon::$tab_index : $starting_index;
	}
}