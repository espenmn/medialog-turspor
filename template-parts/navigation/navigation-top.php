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
	<?php the_custom_logo(); ?>
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

</nav><!-- #site-navigation -->
