<?php
/**
 * Displays top navigation
 *
 * @package medialog_turspor
 * @subpackage Medialog_Turspor
 * @since 1.0
 * @version 1.2
 */

?>
<nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Top Menu', 'medialog_turspor' ); ?>">
	<button class="menu-toggle" aria-controls="top-menu" aria-expanded="false">
		<?php
		echo medialog_turspor_get_svg( array( 'icon' => 'bars' ) );
		echo medialog_turspor_get_svg( array( 'icon' => 'close' ) );
		_e( 'Menu', 'medialog_turspor' );
		?>
	</button>

	<?php wp_nav_menu( array(
		'theme_location' => 'top',
		'menu_id'        => 'top-menu',
	) ); ?>

	<?php if ( ( medialog_turspor_is_frontpage() || ( is_home() && is_front_page() ) ) && has_custom_header() ) : ?>
		<a href="#content" class="menu-scroll-down"><?php echo medialog_turspor_get_svg( array( 'icon' => 'arrow-right' ) ); ?><span class="screen-reader-text"><?php _e( 'Scroll down to content', 'medialog_turspor' ); ?></span></a>
	<?php endif; ?>
</nav><!-- #site-navigation -->
