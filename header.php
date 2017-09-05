<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package medialog_turspor
 * @subpackage Medialog_Turspor
 * @since 1.0
 * @version 1.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'medialog_turspor' ); ?></a>

	<header id="masthead" class="site-header" role="banner">

  <div class="logonav_wrapper">
		<?php if ( has_nav_menu( 'top' ) ) : ?>
			<div class="navigation-top">

				<div class="wrap">
					<?php get_template_part( 'template-parts/navigation/navigation', 'top' ); ?>
				</div><!-- .wrap -->
			</div><!-- .navigation-top -->
		<?php endif; ?>
	</div>

	</header><!-- #masthead -->

	<!--?php
	if ( medialog_turspor_is_frontpage() ) :
		echo '<iframe width="100%" height="700vw" src="https://www.youtube.com/embed/pfoUHOUjsIg?autoplay=1" frameborder="0" allowfullscreen></iframe>';
	endif;
	?-->

	<!--?php get_template_part( 'template-parts/header/header', 'image' ); ?-->


	<?php

	/*
	 * If a regular post or page, and not the front page, show the featured image.
	 * Using get_queried_object_id() here since the $post global may not be set before a call to the_post().
	 */
	if ( ( is_single() || ( is_page() && ! medialog_turspor_is_frontpage() ) ) && has_post_thumbnail( get_queried_object_id() ) ) :
		echo '<div class="single-featured-image-header">';
		echo get_the_post_thumbnail( get_queried_object_id(), 'medialog_turspor-featured-image' );
		echo '</div><!-- .single-featured-image-header -->';
	endif;
	?>

	<div class="site-content-contain">
		<div id="content" class="site-content">
