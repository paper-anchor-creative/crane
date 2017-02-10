<?php
// create custom plugin settings menu
add_action('admin_menu', 'init_crane_settings_page');

function init_crane_settings_page() {

	//create new top-level menu
	add_menu_page('Crane Theme Settings', 'Crane', 'administrator', __FILE__, 'crane_settings_page' , site_url('/wp-content/themes/crane/build/images/crane-icon-sm.png', __FILE__) );

	//call register settings function
	add_action( 'admin_init', 'register_my_cool_plugin_settings' );
}


function register_my_cool_plugin_settings() {
	//register our settings
	register_setting( 'crane-settings-group', 'logo' ); // @todo add support for uploading logo directly to media library
    register_setting( 'crane-settings-group', 'google_ua_code' );
    register_setting( 'crane-settings-group', 'option_etc' );

}

function crane_settings_page() {
?>
<div class="wrap">
<h1>Crane Theme Settings</h1>

<form method="post" action="options.php">
    <?php settings_fields( 'crane-settings-group' ); ?>
    <?php do_settings_sections( 'crane-settings-group' ); ?>
    <table class="form-table">
        <tr valign="top">
        <th scope="row">Logo Path</th>
        <td>
            <input type="text" name="logo" value="<?php echo esc_attr( get_option('logo') ); ?>" />
            <p class="description">Include the path to the media file.</p>
        </td>
        </tr>
         
        <tr valign="top">
        <th scope="row">Google Tracking ID (UA Code)</th>
        <td>
            <input type="text" name="google_ua_code" value="<?php echo esc_attr( get_option('google_ua_code') ); ?>" />
            <p class="description">This address is used for admin purposes, like new user notification.</p>
        </td>
        </tr>
    </table>
    
    <?php submit_button(); ?>

</form>
</div>
<?php } ?>