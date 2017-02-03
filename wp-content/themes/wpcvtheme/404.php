<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package wpcvtheme
 */
global $sam_martin_options;
get_header(); ?>
	<div style="background: url('<?php echo get_template_directory_uri();?>/images/404.jpg');" class="error-bg gradient-01">
		<div class="error">
			<div class="error-contact">
				<div class="container">
					<div class="row">
						<div class="col-md-offset-3 col-md-6 text-center">
							<h2><?php esc_html_e('error','wpcvtheme');?></h2>
							<h1><?php esc_html_e('404','wpcvtheme');?>  </h1>
							<p><?php esc_html_e('opppsss! it looks like you are lost','wpcvtheme');?></p>
							<div class="button">
								<a href="<?php echo esc_url(site_url());?>"><span class="ti-home"></span><?php esc_html_e('return home','wpcvtheme');?></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<?php if($sam_martin_options['site_layout']=='layout_01'):?>
	</section><!-- #content .content-scroller -->
	<?php endif;?>
	
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>