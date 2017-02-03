<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package wpcvtheme
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main blog blog-page white-bg page-section" role="main">

			<div class="container-fluid">
				<div id="massonry-container" class="row">

					<?php
					if ( have_posts() ) : 
					
						/* Start the Loop */
						while ( have_posts() ) : the_post();

							/*
							 * Include the Post-Format-specific template for the content.
							 * If you want to override this in a child theme, then include a file
							 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
							 */
							get_template_part( 'template-parts/content', get_post_format() );

						endwhile;

						

					else :

						get_template_part( 'template-parts/content', 'none' );

					endif; ?>
					</div>
					<?php
					// Previous/next page navigation.
					sam_martin_posts_pagination();
					?>
			</div>

		</main><!-- #main -->
	</div><!-- #primary -->
<?php
get_footer();