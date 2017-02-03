<?php
/**
 * Template part for displaying results in search pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package wpcvtheme
 */

$categories = sam_martin_post_taxonomy( get_the_ID() ,get_post_type());
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('col-xx-12 col-xs-6 col-lg-4 col-md-6 col-sm-6 massonry-item'); ?>>
	<div class="blog-block <?php echo ( (!has_post_thumbnail()) ? 'blog-no-image' : '' );?>">
		<header class="entry-header blog-image recent-post-image">
			<?php if ( has_post_thumbnail() ) {
					the_post_thumbnail('wpcvtheme-post-thumbnails');
				}			
			?>
			<div class="blog-date"><span><?php echo date('M, d',strtotime(get_the_date()));?></span></div>			
		</header><!-- .entry-header -->

		<div class="entry-content blog-info">
			<div class="blog-meta">
				<p><span class="ti-comment-alt"></span> <a href="<?php echo esc_url(get_permalink()).'#comments';?>"><?php echo get_comments_number();?></a></p>
				<p><span class="ti-user"></span><?php the_author_posts_link()?></p>
				<?php if(!empty($categories)):?>
				<p><span class="ti-folder"></span> 
					<?php $i=1; foreach($categories as $category):?>
						<a href="<?php echo esc_url(get_term_link( $category));?>"><?php echo esc_html($category->name);?></a>
						<?php echo ($i!=sizeof($categories))? ', ': '';?>
					<?php $i++; endforeach;?>
				</p>
				<?php endif;?>
			</div>
			<div class="recent-post-info blog-content">
				<h2><a href="<?php the_permalink(); ?>"><?php get_the_title() ? the_title() : the_ID(); ?></a></h2>
				
				<?php the_excerpt()?>
			
				<div class="blog-bottom clearfix">
					<div class="button-small"><a href="<?php the_permalink()?>"><?php esc_html_e('Read More..','wpcvtheme');?></a></div>
					<?php do_action('sam_martin_social_share',get_the_ID());?>
				</div>
			</div>
		</div><!-- .entry-content -->
		
	</div>
</article><!-- #post-## -->