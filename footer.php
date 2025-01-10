<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since Twenty Nineteen 1.0
 */

?>
<?php do_action( 'add_footer' ); ?>

</div><!-- #page -->

<?php wp_footer(); ?>
<?php do_action( 'add_footer_scripts' ); ?>
<?php do_action( 'add_footer_page_custom' ); ?>

</div>
</body>

</html>
