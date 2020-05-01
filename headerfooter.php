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

function fca_hf_footer_output (){
	echo "<script>alert('hello world')</script>";
}
add_action( 'wp_footer', "fca_hf_footer_output" );