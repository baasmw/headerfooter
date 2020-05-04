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


// link input to database
// get wordpress to show the saved code

function fca_hf_register_admin_page(){
	add_menu_page( 'HeaderFooter', 'HeaderFooter', 'edit_posts', 'headerfooter', 'fca_hf_admin_page');
}
add_action( 'admin_menu', 'fca_hf_register_admin_page' );

// Current issues:
	// After entering new values, old values stay in textbox until page is refreshed



function fca_hf_admin_page (){

	$header = get_option('fca_hf_header');
	$footer = get_option('fca_hf_footer');
	$nonce = wp_create_nonce('update_form');

	//var_dump($_POST);

	//ob_start(); ?>

	<h1>HeaderFooter Plugin v0.0.1</h1>
	<form action="admin.php?page=headerfooter" method="post">
		<?php wp_nonce_field( 'update_form', 'nonce_field' );?>
		<p>This text will go into your header</p>
		<textarea name="fca_hf_header"><?php echo get_option('fca_hf_header'); ?></textarea>
		<p>This text will go into your footer</p>
		<textarea name="fca_hf_footer"><?php echo get_option('fca_hf_footer'); ?></textarea>
		<input type="submit">
	</form>
	<?php

	//echo ob_get_clean();
	//echo($nonce);

	if (!empty($_POST)) {
		//echo($nonce);
		if ( !isset ($nonce) ){
			echo('No nonce set!');
		} else {
		// how to link submit button to separate action for the following command?
		update_option('fca_hf_header', $_POST['fca_hf_header']);
		
		}
	}

	if (!empty($_POST)) {
		//echo($nonce);
		if ( !isset ($nonce) ){
			echo('No nonce set!');
		} else {
		// how to link submit button to separate action for the following command?
		update_option('fca_hf_footer', $_POST['fca_hf_footer']);
		}
	}

}

function fca_hf_header_output (){
	echo get_option( 'fca_hf_header' );
}
add_action( 'wp_head', 'fca_hf_header_output' );

function fca_hf_footer_output (){
	echo get_option( 'fca_hf_footer' );
}
add_action( 'wp_footer', 'fca_hf_footer_output' );


