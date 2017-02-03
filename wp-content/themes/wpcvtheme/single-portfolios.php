<?php 
/*
 * Single Portfolios Page Template
 */
get_header(); 

while ( have_posts() ) : the_post(); 
$portfolio_images=get_field('portfolio_images');
$release=get_field('release');
$client_name=get_field('client_name');
$project_url=get_field('project_url');
$portfolio_layout=get_field('portfolio_layout');
$term_tags = wp_get_post_terms(get_the_ID(), 'portfolio_tag');
?>
<!-- single-portfolio-post-->
<section class="single-portfolio-post page-section-pt">
	<div class="container-fluid">		
		
		<div class="row">
			<div class="col-lg-7 col-md-7"> <!--gallery --->				
				<div class="owl-carousel-1">						
					<?php if(!empty($portfolio_images)):?>
						<?php foreach($portfolio_images as $images):?>
								<div class="item">
									<img alt="" src="<?php echo esc_url($images['sizes']['wpcvtheme-portfolio-slider']);?>">
								</div>
						<?php endforeach;?>
					<?php endif;?>
				</div>				
			</div>
			<div class="col-lg-5 col-md-5 clearfix">
				<div class="port-title">				
					<h2 class="mb-30"><?php the_title(); ?></h2>
				</div>
				
				<?php if(!empty($term_tags)):?>
				<!-- Display Portfolio tags -->
				<div class="tags-2">
					<h5><?php esc_html_e('Tags:','wpcvtheme');?></h5>					
					<ul>
						<?php foreach($term_tags as $term) {?>
							<li><a href="<?php echo get_term_link($term->term_id,'portfolio_tag')?>"><?php echo esc_attr($term->name); ?></a></li>
						<?php }?>
					</ul>
				</div>
				<!-- End Portfolio tags -->
				<?php endif;?>
				
				<div class="port-meta clearfix"> <!-- get meta data -->
					<ul>
						<?php 
						$term_list = wp_get_post_terms(get_the_ID(), 'portfolio_skills');
						$skills=array();
						foreach($term_list as $term)
							$skills[]=$term->name;
						?>						
						<?php if($release):?>
						<li><b><?php esc_html_e('Release:','wpcvtheme'); ?></b><span><?php echo date('d/m/Y',strtotime($release));?> </span></li>
						<?php endif;?>
						
						<?php if($client_name):?>
						<li><b><?php esc_html_e('Client:','wpcvtheme');?></b><span><?php echo esc_attr($client_name);?></span></li>
						<?php endif;?>
						
						<?php if($project_url):?>
						<li><b><?php esc_html_e('Live Demo:','wpcvtheme');?> </b><span><?php echo esc_attr($project_url);?></span></li>						
						<?php endif;?>
						
						<?php if(!empty($skills)):?>
						<li><b><?php esc_html_e('Skills:','wpcvtheme');?> </b><span><?php echo implode(', ',$skills); ?></span></li>
						<?php endif;?>
					</ul>
				</div>
				
				<div class="port-info">					 
					<?php the_content(); ?>
				</div>
			</div>
		</div>
		
		<?php sam_martin_authro_infobox();?>
    </div>
</section>
<!--single-portfolio-post-->
<?php endwhile; // end of the loop. ?>
<?php get_footer(); ?>