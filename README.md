# Enable Placeholders, Tabindex Conflicts for Gravity Forms

**Contributors:** Organización Educativa Continental
**Plugin URI:** https://github.com/unicontinental/placeholder_gravityforms
**Tags:** gravity forms, gravityforms, placeholder, tabindex, accessibility, form
**Requires at least:** WordPress 4.3 (originally tested on this version)
**Tested up to:** WordPress 4.3 (original test environment, plugin updated to v0.3.0)
**Requires PHP:** 5.6 (assumed reasonable minimum)
**Stable tag:** 0.3.0
**License:** GPLv2 or later
**License URI:** https://www.gnu.org/licenses/gpl-2.0.html

A WordPress plugin that enhances Gravity Forms by enabling HTML5 placeholders and resolving tabindex conflicts.

## Description

This plugin provides two key enhancements for Gravity Forms:

1.  **Enable Placeholders:** It allows you to use HTML5 placeholders in your form fields and provides the option to hide field labels, letting the placeholder text serve as the de facto label. This can lead to cleaner and more modern form designs. The functionality integrates with Gravity Forms' native "Field Label Visibility" settings.

2.  **Fix Tabindex Conflicts:** It automatically adjusts the `tabindex` attribute for Gravity Forms fields, starting them from a higher value (default: 1000). This helps prevent conflicts with other elements on your page that use `tabindex`, ensuring a smoother and more logical tab navigation experience for users, which is especially important for accessibility.

This plugin requires Gravity Forms to be installed and activated.

## Installation

1.  **Upload Method:**
    *   Download the plugin ZIP file from [GitHub](https://github.com/unicontinental/placeholder_gravityforms/releases) (if available as a release) or from its source.
    *   Log in to your WordPress admin panel.
    *   Navigate to **Plugins > Add New**.
    *   Click on **Upload Plugin**.
    *   Choose the downloaded ZIP file and click **Install Now**.
    *   Activate the plugin.

2.  **Manual Method:**
    *   Unzip the plugin package.
    *   Upload the `placeholder_gravityforms` (or similarly named) directory to the `/wp-content/plugins/` directory on your server.
    *   Log in to your WordPress admin panel.
    *   Navigate to **Plugins > Installed Plugins**.
    *   Find "Enable Placeholders, Tabindex Conflicts" and click **Activate**.

**Prerequisite:** Ensure that Gravity Forms is installed and activated before using this plugin.

## How to Use

### Enabling Placeholders

1.  Ensure the "Enable Placeholders, Tabindex Conflicts" plugin is activated.
2.  Edit any Gravity Form.
3.  Click on the field you want to modify to open its settings.
4.  Go to the **Appearance** tab in the field settings.
5.  For the **Field Label Visibility** option, select **Hidden** from the dropdown.
6.  Enter your desired placeholder text in the **Placeholder** input box.
7.  Save your form.

The field will now display the placeholder text, and the original label will be hidden.

### Tabindex Conflict Fix

This feature works automatically once the plugin is activated. No further configuration is required. Gravity Forms field `tabindex` values will begin at 1000 (or higher if Gravity Forms' own count is already above this), helping to avoid conflicts with other page elements.

## Frequently Asked Questions

**Q: Does this plugin work with the latest version of Gravity Forms?**
A: This plugin was originally built to enable placeholder functionality that became more robust around Gravity Forms v1.9.1+. The tabindex fix is generally compatible. It uses standard Gravity Forms hooks that should maintain compatibility. However, always test in a staging environment with the latest versions. (Plugin version 0.3.0)

**Q: Can I change the starting tabindex value?**
A: Yes, as of version 0.3.0. The plugin now includes a filter `pgf_tabindex_start_index` that allows you to change the default starting tabindex value of 1000. You can add code to your theme's `functions.php` file or a custom plugin like this:
   ```php
   add_filter( 'pgf_tabindex_start_index', 'custom_tabindex_start' );
   function custom_tabindex_start( $default_start_index ) {
       // Change the starting tabindex to 2000, for example
       return 2000;
   }
   ```

## Changelog

### 0.3.0
*   Enhanced: Added a filter `pgf_tabindex_start_index` to allow developers to customize the starting tabindex value.
*   Enhanced: Prefixed internal function `gform_tabindexer` to `pgf_gform_tabindexer` to prevent potential naming conflicts.
*   Maintenance: Updated plugin header information (Version, License, Text Domain, Instructions).
*   Maintenance: Added standard WordPress security check (`ABSPATH`).
*   Maintenance: Improved PHPDoc blocks and inline comments for better code clarity.

### 0.2.0.2
*   Initial version providing placeholder enablement and tabindex conflict resolution.
*   (Note: This changelog is based on the available version information. Specific changes for this version are not detailed in the source files.)

## Notes

*   This plugin was originally tested on WordPress 4.3. For best results, use with modern versions of WordPress and Gravity Forms.
*   The placeholder functionality relies on the filter `gform_enable_field_label_visibility_settings`.
*   The tabindex fix uses the filter `gform_tabindex`.
