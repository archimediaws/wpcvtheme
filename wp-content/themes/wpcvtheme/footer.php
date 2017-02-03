<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package wpcvtheme
 */
global $sam_martin_options;
	if(is_plugin_active('redux-framework/redux-framework.php')){
?>
	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="container-fluid">
			<div id="google-map">
				<div id="map-canvas"></div>
			</div>
			
			<?php if (  is_active_sidebar( 'footer' ) ): ?>
				<div class="contact"><?php dynamic_sidebar( 'footer' ); ?></div>	
			<?php endif;?>
			
			<?php if($sam_martin_options['footre_contact_icon']=='yes'):?>
				<div class="contact-form">
					<div id="contact-wrapper">
						<div class="contact-content">						 
							<div class="contact-form">
								<?php
								if( isset($sam_martin_options['contact_title']) && !empty($sam_martin_options['contact_title']) ){
									?>
									<h4><?php echo esc_html($sam_martin_options['contact_title']); ?></h4>
									<?php
								}
								if( isset($sam_martin_options['contact_description']) && !empty($sam_martin_options['contact_description']) ){
									?>
									<p><?php echo esc_html($sam_martin_options['contact_description']);?></p>
									<?php
								}
								if( isset($sam_martin_options['contact_form_7_shortcode']) && !empty($sam_martin_options['contact_form_7_shortcode']) ){
									?>
									<div class="footer_contact_info">
										<?php
										echo wpautop( do_shortcode( wp_kses( $sam_martin_options['contact_form_7_shortcode'],
											array()
										) ) );
										?>
									</div>
									<?php
								}
								?>
							</div>
						</div>
						<a href="#" class="contact-toggle"><span class="ti-comments"></span></a>
					</div>
				</div>
			<?php endif;?>
			
		</div>
	</footer><!-- #colophon -->	
	<?php 	
	} /* check condition for redux plugin activate */
	
	if($sam_martin_options['site_layout']=='layout_01' || !isset($sam_martin_options['site_layout'])):?>
	</section><!-- #content .content-scroller -->
	<?php endif;?>
	
</div><!-- #page -->
<?php wp_footer(); ?>
</body>
</html>