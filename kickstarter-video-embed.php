<?php
/*
 * Plugin Name: Kickstarter Video Embed
 * Description: Adds Kickstarter to the list of supported oEmbed providers.
 * Plugin URI: https://wordpress.org/plugins/kickstarter-video-embed/
 * Author: Drew Jaynes
 * Author URI: http://werdswords.com
 * License: GPLv2 or later
 * Version: 2.0
 */

/**
 * (Maybe) deactivate the plugin for WordPress 4.2+.
 *
 * @since 2.0
 */
function kve_maybe_deactivate_plugin() {
	if ( version_compare( get_bloginfo( 'version' ), '4.2', '>=' ) ) {

		if ( current_user_can( 'activate_plugins' ) ) {
			add_action( 'admin_init', 'kve_deactivate_plugin' );
			add_action( 'admin_notices', 'kve_deactivate_plugin_notice' );
		}
	}
}
add_action( 'plugins_loaded', 'kve_maybe_deactivate_plugin' );

/**
 * Register the Kickstarter oEmbed endpoint.
 *
 * @since 1.0
 */
function kve_register_oembed_provider() {
	wp_oembed_add_provider( '#https://(www.)?kickstarter.com/projects/.*#i', 'http://www.kickstarter.com/services/oembed', true );
}
add_action( 'plugins_loaded', 'kve_register_oembed_provider' );

/**
 * Utility method to self-deactivate for WordPress 4.2+.
 *
 * @since 2.0
 */
function kve_deactivate_plugin() {
	deactivate_plugins( plugin_basename( __FILE__ ) );
}

/**
 * Utility method to display a self-deactivation notice for WordPress 4.2+.
 *
 * @since 2.0
 */
function kve_deactivate_plugin_notice() {
	?>
	<div class="updated notice is_dismissible">
		<p>WordPress now <a href="https://codex.wordpress.org/Embeds#Okay.2C_So_What_Sites_Can_I_Embed_From.3F">supports</a> Kickstarter oEmbeds as of 4.2. The <strong>Kickstarter Video Embed</strong> has been automatically <strong>deactivated</strong>.</p>
	</div>
	<?php
	if ( isset( $_GET['activate'] ) ) {
		unset( $_GET['activate'] );
	}
}
