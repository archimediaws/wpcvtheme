<?php
/*
 * Category posts widget
 */
class sam_martin_contactus_widget extends WP_Widget{
	
	/**
	 * Constructor
	 */
	public function __construct() {		
		
		$widget_ops = array('classname' => 'widget_sammartin_contactus', 'description' => esc_html__( 'Display Contact information','wpcvtheme') );
		parent::__construct('contact_info', esc_html__('Display Contact information ','wpcvtheme'), $widget_ops);
	}
	
	
	public function widget( $args, $instance ) {
		
		extract( $args );	
		
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'address' => '' ,'email'=>'','phone_no'=>'','fax_no'=>'','social_title'=>'','social_description'=>'','facebook'=>'','twitter'=>'','dribbble'=>'','vimeo'=>'','pinterest'=>'','behance'=>'','linkedin'=>'','button_text'=>'Download my CV','download_file'=>'') );

		
		$title             = empty( $instance['title'] )             ? esc_html__('Contact Us', 'wpcvtheme'): apply_filters( 'widget_title', $instance['title'] );
		$address           = empty( $instance['address'] )           ? ''                            : apply_filters( 'widget_address', $instance['address'] );
		$email             = empty( $instance['email'] )             ? ''                            : apply_filters( 'widget_email', $instance['email'] );
		$phone_no          = empty( $instance['phone_no'] )          ? ''                            : apply_filters( 'widget_phone_no', $instance['phone_no'] );
		$fax_no            = empty( $instance['fax_no'] )            ? ''                            : apply_filters( 'widget_fax_no', $instance['fax_no'] );
		$social_title      = empty( $instance['social_title'] )      ? ''                            : apply_filters( 'widget_social_title', $instance['social_title'] );
		$social_description= empty( $instance['social_description'] )? ''                            : apply_filters( 'widget_social_description', $instance['social_description'] );
		$facebook          = empty( $instance['facebook'] )          ? ''                            : apply_filters( 'widget_facebook', $instance['facebook'] );
		$twitter           = empty( $instance['twitter'] )           ? ''                            : apply_filters( 'widget_twitter', $instance['twitter'] );
		$dribbble          = empty( $instance['dribbble'] )          ? ''                            : apply_filters( 'widget_dribbble', $instance['dribbble'] );
		$vimeo             = empty( $instance['vimeo'] )             ? ''                            : apply_filters( 'widget_vimeo', $instance['vimeo'] );
		$pinterest         = empty( $instance['pinterest'] )         ? ''                            : apply_filters( 'widget_pinterest', $instance['pinterest'] );
		$behance           = empty( $instance['behance'] )           ? ''                            : apply_filters( 'widget_behance', $instance['behance'] );
		$linkedin          = empty( $instance['linkedin'] )          ? ''                            : apply_filters( 'widget_linkedin', $instance['linkedin'] );
		
		$button_text       = empty( $instance['button_text'] )       ? ''                            : apply_filters( 'widget_button_text', $instance['button_text'] );
		$download_file     = empty( $instance['download_file'] )     ? ''                            : apply_filters( 'widget_download_file', $instance['download_file'] );   
		
		echo $before_widget;	
		if($title)
			echo $before_title .  esc_html($title) . $after_title;
		?>
		<div class="address">
			<ul>
				<?php if($address!=''):?>
					<li><span class="ti-location-pin"></span> <p><?php echo esc_html($address);?></p> </li>
				<?php endif;
				
				if($email!=''):?>
					<li><span class="ti-marker-alt"></span> <p><?php echo esc_html($email);?></p></li>
				<?php endif;
				
				if($phone_no!=''):?>
					<li><span class="ti-mobile"></span> <p><?php echo esc_html($phone_no);?></p></li>
				<?php endif;
				
				if($fax_no!=''):?>
					<li><span class="ti-printer"></span> <p><?php echo esc_html($fax_no);?></p></li>
				<?php endif;?>
			</ul>
		</div>
		<div class="social">
			<?php if($social_title):?>
				<h4><?php echo esc_html($social_title);?></h4>
			<?php endif;
			
			if($social_description):?>
				<p><?php echo esc_html($social_description);?></p>
			<?php endif; ?>
			<ul>
				<?php if($facebook!=''):?>
					<li><a href="<?php echo esc_url($facebook);?>"><i class="fa fa-facebook"></i></a></li>
				<?php endif;
				
				if($twitter):?>
					<li><a href="<?php echo esc_url($twitter)?>"><i class="fa fa-twitter"></i></a></li>
				<?php endif;
				
				if($dribbble):?>
					<li><a href="<?php echo esc_url($dribbble)?>"><i class="fa fa-dribbble"></i> </a></li>
				<?php endif;
				
				if($vimeo):?>
					<li><a href="<?php echo esc_url($vimeo)?>"><i class="fa fa-vimeo"></i> </a></li>
				<?php endif;
				
				if($pinterest):?>
					<li><a href="<?php echo esc_url($pinterest)?>"><i class="fa fa-pinterest-p"></i> </a></li>
				<?php endif;
				
				if($behance):?>
					<li><a href="<?php echo esc_url($behance)?>"><i class="fa fa-behance"></i> </a></li>
				<?php endif;
				
				if($linkedin):?>
					<li><a href="<?php echo esc_url($linkedin)?>"><i class="fa fa-linkedin"></i> </a></li>
				<?php endif;?>
			</ul>
		</div>
		<?php if($button_text!='' && $download_file!=''):?>
			<div class="button-large"><a href="<?php echo esc_url($download_file);?>"><?php echo esc_html($button_text);?></a></div>
		<?php
		endif;
		
		echo $after_widget;			
			
	}	
	
	public function update( $new_instance, $old_instance ) {
		
		return $new_instance;
	}
	
	public function form( $instance) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'address' => '' ,'email'=>'','phone_no'=>'','fax_no'=>'','social_title'=>'','social_description'=>'','facebook'=>'#','twitter'=>'#','dribbble'=>'#','vimeo'=>'#','pinterest'=>'#','behance'=>'#','linkedin'=>'#','button_text'=>'Download my CV','download_file'=>'#') );
		
		$title             = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$address           = strip_tags($instance['address']);
		$email             = strip_tags($instance['email']);
		$phone_no          = strip_tags($instance['phone_no']);
		$fax_no            = strip_tags($instance['fax_no']);
		$social_title      = strip_tags($instance['social_title']);
		$social_description= strip_tags($instance['social_description']);
		$facebook          = strip_tags($instance['facebook']);
		$twitter           = strip_tags($instance['twitter']);
		$dribbble          = strip_tags($instance['dribbble']);
		$vimeo             = strip_tags($instance['vimeo']);
		$pinterest         = strip_tags($instance['pinterest']);
		$behance           = strip_tags($instance['behance']);
		$linkedin          = strip_tags($instance['linkedin']);
		$button_text       = strip_tags($instance['button_text']);
		$download_file     = strip_tags($instance['download_file']);
		?>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title','wpcvtheme'); ?>:</label> 
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('address')); ?>"><?php esc_html_e('Address','wpcvtheme'); ?>:</label> 
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('address')); ?>" name="<?php echo esc_attr($this->get_field_name('address')); ?>" type="text" value="<?php echo esc_attr($address); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('email')); ?>"><?php esc_html_e('Email','wpcvtheme'); ?>:</label> 
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('email')); ?>" name="<?php echo esc_attr($this->get_field_name('email')); ?>" type="text" value="<?php echo esc_attr($email); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('phone_no')); ?>"><?php esc_html_e('Phone#','wpcvtheme'); ?>:</label> 
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('phone_no')); ?>" name="<?php echo esc_attr($this->get_field_name('phone_no')); ?>" type="text" value="<?php echo esc_attr($phone_no); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('fax_no')); ?>"><?php esc_html_e('fax#','wpcvtheme'); ?>:</label> 
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('fax_no')); ?>" name="<?php echo esc_attr($this->get_field_name('fax_no')); ?>" type="text" value="<?php echo esc_attr($fax_no); ?>" />
		</p>
		<hr/>
		<p><?php esc_html_e('Social Information','wpcvtheme');?></p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('social_title')); ?>"><?php esc_html_e('Title','wpcvtheme'); ?>:</label> 
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('social_title')); ?>" name="<?php echo esc_attr($this->get_field_name('social_title')); ?>" type="text" value="<?php echo esc_attr($social_title); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('social_description')); ?>"><?php esc_html_e('Description','wpcvtheme'); ?>:</label> 
			<textarea class="widefat" id="<?php echo esc_attr($this->get_field_id('social_description')); ?>" name="<?php echo esc_attr($this->get_field_name('social_description')); ?>"><?php echo esc_attr($social_description); ?></textarea>
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('facebook')); ?>"><?php esc_html_e('Facebook','wpcvtheme'); ?>:</label> 
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('facebook')); ?>" name="<?php echo esc_attr($this->get_field_name('facebook')); ?>" type="text" value="<?php echo esc_attr($facebook); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('twitter')); ?>"><?php esc_html_e('Twitter','wpcvtheme'); ?>:</label> 
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('twitter')); ?>" name="<?php echo esc_attr($this->get_field_name('twitter')); ?>" type="text" value="<?php echo esc_attr($twitter); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('dribbble')); ?>"><?php esc_html_e('Dribbble','wpcvtheme'); ?>:</label> 
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('dribbble')); ?>" name="<?php echo esc_attr($this->get_field_name('dribbble')); ?>" type="text" value="<?php echo esc_attr($dribbble); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('vimeo')); ?>"><?php esc_html_e('Vimeo','wpcvtheme'); ?>:</label> 
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('vimeo')); ?>" name="<?php echo esc_attr($this->get_field_name('vimeo')); ?>" type="text" value="<?php echo esc_attr($vimeo); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('pinterest')); ?>"><?php esc_html_e('Pinterest','wpcvtheme'); ?>:</label> 
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('pinterest')); ?>" name="<?php echo esc_attr($this->get_field_name('pinterest')); ?>" type="text" value="<?php echo esc_attr($pinterest); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('behance')); ?>"><?php esc_html_e('Behance','wpcvtheme'); ?>:</label> 
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('behance')); ?>" name="<?php echo esc_attr($this->get_field_name('behance')); ?>" type="text" value="<?php echo esc_attr($behance); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('linkedin')); ?>"><?php esc_html_e('Linkedin','wpcvtheme'); ?>:</label> 
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('linkedin')); ?>" name="<?php echo esc_attr($this->get_field_name('linkedin')); ?>" type="text" value="<?php echo esc_attr($linkedin); ?>" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('button_text')); ?>"><?php esc_html_e('Button Text','wpcvtheme'); ?>:</label> 
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('button_text')); ?>" name="<?php echo esc_attr($this->get_field_name('button_text')); ?>" type="text" value="<?php echo esc_attr($button_text); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('download_file')); ?>"><?php esc_html_e('Download File','wpcvtheme'); ?>:</label> 
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('download_file')); ?>" name="<?php echo esc_attr($this->get_field_name('download_file')); ?>" type="text" value="<?php echo esc_attr($download_file); ?>" />
		</p>
		<?php
	}
	
}

register_widget( 'sam_martin_contactus_widget' );
?>