<?php
/**
 * Plugin Name: Enable Placeholders, Tabindex Conflicts
 * Plugin URI: https://github.com/unicontinental/placeholder_gravityforms
 * Description: Enable placeholders in Gravity Forms and fix Gravity Forms tabindex conflicts by adjusting the starting tabindex.
 * Version: 0.3.0
 * Author: Organización Educativa Continental
 * Author URI: https://github.com/unicontinental/placeholder_gravityforms
 * License: GPLv2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: placeholder-gravityforms
 * Domain Path: /languages
 * Instructions: Activate plugin. The starting tabindex for Gravity Forms can be modified using the 'pgf_tabindex_start_index' filter.
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( class_exists( 'GFForms' ) ) {

	/**
	 * Enable Gravity Forms Placeholders.
	 *
	 * This filter enables the 'Field Label Visibility' setting in the Gravity Forms
	 * field editor, allowing labels to be hidden so placeholders can act as labels.
	 */
	add_filter( 'gform_enable_field_label_visibility_settings', '__return_true' );

	/**
	 * Modify the starting tabindex for Gravity Forms to prevent conflicts.
	 *
	 * @since 0.2.0.2
	 * @since 0.3.0 Added 'pgf_tabindex_start_index' filter and prefixed function name.
	 *
	 * @param int   $tab_index The current tabindex.
	 * @param array|bool $form The current form object, or false if not available.
	 * @return int The potentially modified tabindex.
	 */
	function pgf_gform_tabindexer( $tab_index, $form = false ) {
		/**
		 * Filter the starting tabindex value.
		 *
		 * @since 0.3.0
		 *
		 * @param int $starting_index The default starting tabindex (1000).
		 * @param array|false $form The current form object, or false if not available.
		 */
		$starting_index = apply_filters( 'pgf_tabindex_start_index', 1000, $form );

		// Ensure $starting_index is an integer.
		$starting_index = absint( $starting_index );

		// If a specific form is passed, ensure this filter is also applied per form.
		// This maintains compatibility with how Gravity Forms might handle tabindex internally for specific forms.
		// Note: Gravity Forms itself adds this filter `gform_tabindex_{$form['id']}`.
		// Re-adding it here for the specific form ID ensures our pgf_gform_tabindexer is used if that specific filter is called.
		if ( $form && isset( $form['id'] ) ) {
			add_filter( 'gform_tabindex_' . $form['id'], 'pgf_gform_tabindexer', 10, 2 );
		}

		// If Gravity Forms' current tabindex is already higher than our starting index, respect it.
		// Otherwise, start from our defined $starting_index.
		// GFCommon::$tab_index is incremented by Gravity Forms itself.
		return GFCommon::$tab_index >= $starting_index ? GFCommon::$tab_index : $starting_index;
	}
	add_filter( 'gform_tabindex', 'pgf_gform_tabindexer', 10, 2 );

} // End if class_exists('GFForms')

?>
