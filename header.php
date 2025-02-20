<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since Twenty Nineteen 1.0
 */
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<link rel="profile" href="https://gmpg.org/xfn/11" />
    <?php do_action( 'add_fav_icons' ); ?>
    <?php do_action( 'add_header_scripts' ); ?>
    <?php do_action( 'add_header_page_custom' ); ?>
	<?php wp_head(); ?>
	
</head>

<body <?php body_class(); ?>>

<?php wp_body_open(); ?>
<?php do_action( 'add_header' ); ?>

