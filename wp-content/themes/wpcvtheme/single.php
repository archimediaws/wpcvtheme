<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package wpcvtheme
 */

get_header(); ?>

	<div id="primary" class="content-area blog blog-single white-bg page-section-pt">
		<div id="main" class="site-main container-fluid" role="main">
			<div class="row">
				<div class="col-lg-9 ">
				<?php
				while ( have_posts() ) : the_post();

					if(function_exists('get_field')){
						$images = get_field('images');
					} 			
					?>					
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>						
						
						<?php if( !empty($images )):?>
							<div class="owl-carousel-1">
							<?php foreach($images as $image):?>
								<div class="item"> <img src="<?php echo esc_url($image['sizes']['sam-martin-post-images']); ?>" alt="<?php echo esc_attr($image['alt']); ?>"> </div>
							<?php endforeach;?>
							</div>
						<?php else:?>
							<div class="post-thumbnail">
								<?php the_post_thumbnail(); ?>
							</div><!-- .post-thumbnail -->
						<?php endif;?>
						<div class="entry-content content">
							<?php
								the_content( sprintf(
									/* translators: %s: Name of current post. */
									wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'wpcvtheme' ), array( 'span' => array( 'class' => array() ) ) ),
									the_title( '<span class="screen-reader-text">"', '"</span>', false )
								) );

								wp_link_pages( array(
									'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'wpcvtheme' ),
									'after'  => '</div>',
								) );
							?>
						</div><!-- .entry-content -->
						
					</article><!-- #post-## -->
					<?php

					the_post_navigation();

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;

				endwhile; // End of the loop.
				?>
				</div>
				<div class="col-lg-3">
					<?php get_sidebar();?>
				</div>
			</div>
		</div><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();