<?php
/**
 * Template Name: Home Page
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package wpcvtheme
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<div class="entry-content-section">
						<?php the_content(); ?>
					</div><!-- .entry-content -->	
				</article><!-- #post-## -->				

			<?php endwhile; // End of the loop.	?>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
