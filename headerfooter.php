<?php
/*
	Plugin Name: HeaderFooter
	Description: Provides an easy way to add headers and footers
	Text Domain: headerfooter
	Domain Path: /languages
	Author: Fatcat Apps
	Author URI: https://fatcatapps.com/
	License: GPLv2
	Version: 0.0.1
*/

// BASIC SECURITY
defined( 'ABSPATH' ) or die( 'Unauthorized Access!' );

// ADD PLUGIN TO ADMIN PAGE
function fca_hf_register_admin_page(){
	add_menu_page( 'HeaderFooter', 'HeaderFooter', 'edit_posts', 'headerfooter', 'fca_hf_admin_page');
}
add_action( 'admin_menu', 'fca_hf_register_admin_page' );

// UPDATE PLUGIN PAGE
function fca_hf_admin_page (){

	if ( !empty( $_POST ) ) {

		$nonce = sanitize_text_field( $_POST['nonce_field'] );

		if ( wp_verify_nonce( $nonce , 'fca_hf_update_form' ) === FALSE ){
			wp_die( 'Validation failed!' );
		} else {
			update_option( 'fca_hf_header', $_POST['fca_hf_header'] );
			update_option( 'fca_hf_footer', $_POST['fca_hf_footer'] );
		}
	}

	$header = wp_unslash( get_option( 'fca_hf_header' ) );
	$footer = wp_unslash( get_option( 'fca_hf_footer' ) );
	$nonce = wp_create_nonce( 'fca_update_form' );

	?>

	<h1>HeaderFooter Plugin v0.0.1</h1>
	<form action="admin.php?page=headerfooter" method="post">
		<?php wp_nonce_field( 'fca_hf_update_form', 'nonce_field' );?>
		<p>This text will go into your header</p>
		<textarea name="fca_hf_header"><?php echo $header ?></textarea>
		<p>This text will go into your footer</p>
		<textarea name="fca_hf_footer"><?php echo $footer ?></textarea>
		<input type="submit">
	</form>
	<?php

}

// ADD HEADER TEXT TO MAIN PAGE
function fca_hf_header_output (){
	echo wp_unslash( get_option( 'fca_hf_header' ) );
}
add_action( 'wp_head', 'fca_hf_header_output' );

// ADD HEADER TEXT TO MAIN PAGE
function fca_hf_footer_output (){
	echo wp_unslash( get_option( 'fca_hf_footer' ) );
}
add_action( 'wp_footer', 'fca_hf_footer_output' );

function fca_hf_shortcode () {
	return 'hello world';

}
add_shortcode( 'fca_hf', 'fca_hf_shortcode' );






