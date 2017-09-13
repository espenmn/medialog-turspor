<?php
/**
 * The front page template file
 *
 * If the user has selected a static page for their homepage, this is what will
 * appear.
 * Learn more: https://codex.wordpress.org/Template_Hierarchy
 *
 * @package medialog_turspor
 * @subpackage Medialog_Turspor
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>


<div id="primary" class="content-area">
	<iframe width="100%" height="900vw" src="https://www.youtube.com/embed/2LQwsYu4iFU?autoplay=1&loop=1&modestbranding=1&autohide=1&showinfo=0&controls=0&rel=0&playlist=2LQwsYu4iFU&color=white" 
	frameborder="0" allowfullscreen></iframe>
	<main id="main" class="site-main" role="main">

		<?php // Show the selected frontpage content.
		if ( have_posts() ) :
			while ( have_posts() ) : the_post();
				get_template_part( 'template-parts/page/content', 'front-page' );
			endwhile;
		else : // I'm not sure it's possible to have no posts when this page is shown, but WTH.
			get_template_part( 'template-parts/post/content', 'none' );
		endif; ?>

		<?php
		// Get each of our panels and show the post data.
		if ( 0 !== medialog_turspor_panel_count() || is_customize_preview() ) : // If we have pages to show.

			/**
			 * Filter number of front page sections in Medialog Turspor.
			 *
			 * @since Medialog Turspor 1.0
			 *
			 * @param int $num_sections Number of front page sections.
			 */
			$num_sections = apply_filters( 'medialog_turspor_front_page_sections', 4 );
			global $medialog_tursporcounter;

			// Create a setting and control for each of the sections available in the theme.
			for ( $i = 1; $i < ( 1 + $num_sections ); $i++ ) {
				$medialog_tursporcounter = $i;
				medialog_turspor_front_page_section( null, $i );
			}

	endif; // The if ( 0 !== medialog_turspor_panel_count() ) ends here. ?>

    <div id="forsideturer">
        <?php echo do_shortcode('[pods name="tur" limit="40" template="Forsideturtemplate"]'); ?>
    </div>

	</main><!-- #main -->
</div><!-- #primary -->

<?php get_footer();
