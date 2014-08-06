<?php
/*
 * Plugin Name: Kickstarter Video Embed
 * Description: Adds Kickstarter to the list of supported oEmbed providers.
 * Plugin URI: https://wordpress.org/plugins/kickstarter-video-embed/
 * Author: Drew Jaynes
 * Author URI: http://werdswords.com
 * License: GPLv2 or later
 * Version: 1.0
 */

/**
 * Register the Kickstarter oEmbed endpoint.
 *
 * @since 1.0
 */
function kve_register_oembed_provider() {
	wp_oembed_add_provider( '#https://(www.)?kickstarter.com/projects/.*#i', 'http://www.kickstarter.com/services/oembed', true );
}
add_action( 'plugins_loaded', 'kve_register_oembed_provider' );
