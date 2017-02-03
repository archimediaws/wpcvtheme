<?php
if(is_front_page())
	return;
global $sam_martin_options;
if( is_home() && get_option('page_for_posts') ) {
	$page_id = get_option('page_for_posts');
} else {
	if( is_object($post) ){
		$page_id = $post->ID;
	}else{
		$page_id = 0;
	}
}
$show_header_banner = $subtitle = $banner_type = $banner_image_bg['url'] = $banner_image_opacity_custom_color = $banner_image_opacity_custom_opacity = '';

if(function_exists('get_field')){
	$subtitle  = get_field('subtitle',$page_id);
	$show_header_banner  = get_field('show_header_banner',$page_id);
	$enable_custom_banner  = get_field('enable_custom_banner',$page_id);
	$banner_type  = get_field('banner_type',$page_id);
	$banner_image_bg  = get_field('banner_image_bg',$page_id);
	$banner_image_opacity_custom_color  = get_field('banner_image_opacity_custom_color',$page_id);
	$banner_image_opacity_custom_opacity  = get_field('banner_image_opacity_custom_opacity',$page_id);

	$banner_image_color  = get_field('banner_image_color',$page_id);
}
$banner_type=($banner_type!='')? $banner_type : $sam_martin_options['header_banner_type'];
/* set background color or background image */
if($banner_type=='color'){
	
	$style['background-color']=	($banner_image_color!='')? $banner_image_color : $sam_martin_options['header_background_color'];
	
}else{
	$bg_banner_img=($banner_image_bg['url']!='')? $banner_image_bg['url'] : $sam_martin_options['header_banner_image']['url'];
	$style['background-image']="url('".esc_url($bg_banner_img)."')";
	
	/* Set the background opacity */
	$bg_color=($banner_image_opacity_custom_color!='')? $banner_image_opacity_custom_color : $sam_martin_options['header_background_color_opacity'];
	
	$bg_opacity=($banner_image_opacity_custom_opacity!='')? $banner_image_opacity_custom_opacity : $sam_martin_options['header_background_opacity'];
	$banner_color = sam_martin_hex2rgba($bg_color, $bg_opacity);	
}
$inline_style='';
foreach($style as $key=>$value){
	$inline_style.=$key.":".$value.";";
}

$inner_class='';
if($sam_martin_options['site_layout']=='layout_02'){
	$inner_class='page-inner';
}elseif($sam_martin_options['site_layout']=='layout_03'){
	$inner_class='page-inner-3';
}
if($show_header_banner ||  is_single() || is_category() || is_search() || is_author() || is_archive() || is_page() || is_home()):
	?>
	<div class="page-header bg gradient-01 <?php echo esc_attr($inner_class);?>" style="<?php echo esc_attr($inline_style);?>">
		<div class="container-fluid">
			<div class="row">
				<div class="top-bar clearfix">
					<div class="back-home pull-left col-md-4 col-sm-4 col-xs-12">
						<a href="<?php echo site_url();?>"><span class="ti-angle-left"></span><?php esc_html_e('back to home','wpcvtheme');?></a>
					</div>					
					<?php sam_martin_breadcrumbs(); ?>					
				</div>
				<div class="page-header-title">
					<h1 class="page-title">
						<?php if(is_single()):
							echo esc_html(get_the_title($page_id));
						elseif(is_archive()):						
							the_archive_title(  );
						elseif(is_search()):
							printf( esc_html__( 'Search Results for: %s', 'wpcvtheme' ), '<span>' . get_search_query() . '</span>' );
						else:
							echo esc_html(get_the_title($page_id)); 
						endif;?>
					</h1>
					<!-- page Subtile-->
					<span><?php echo esc_html($subtitle);?></span>
					
					<?php if(is_single()):
						while ( have_posts() ) : the_post();
							
							if(get_post_type()=='portfolios'){
								?>
								<span><?php echo sprintf( esc_html__( 'By %s', 'wpcvtheme' ), get_the_author() );?></span>
								<?php								
							}else{
							
								$categories = sam_martin_post_taxonomy( get_the_ID() ,get_post_type());
							?>
								
								<div class="blog-meta">
									<p><span class="ti-comment-alt"></span> <a href="<?php echo esc_url(get_permalink()).'#comments';?>"><?php echo get_comments_number();?></a></p>
									<p><span class="ti-user"></span> <?php the_author_posts_link();?></p>
									<?php if(!empty($categories)):?>
										<p><span class="ti-folder"></span> 
											<?php $i=1; foreach($categories as $category):?>
												<a href="<?php echo esc_url(get_term_link( $category));?>"><?php echo esc_html($category->name);?></a>
												<?php echo ($i!=sizeof($categories))? ', ': '';?>
											<?php $i++; endforeach;?>
										</p>
									<?php endif;?>
								</div>
							<?php 
							}
						endwhile;
					endif;?>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>