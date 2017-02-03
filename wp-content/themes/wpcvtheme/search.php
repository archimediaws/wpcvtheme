<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package wpcvtheme
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main blog blog-page white-bg page-section" role="main">

			<div class="container-fluid">
				<div <?php if ( have_posts() ):?>id="massonry-container" <?php endif;?> class="row">

					<?php
					if ( have_posts() ) : 
					
						/* Start the Loop */
						while ( have_posts() ) : the_post();

							/**
							 * Run the loop for the search to output the results.
							 * If you want to overload this in a child theme then include a file
							 * called content-search.php and that will be used instead.
							 */
							get_template_part( 'template-parts/content', 'search' );

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
