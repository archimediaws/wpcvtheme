<?php
class WP_sam_martin_Recent_Posts extends WP_Widget_Recent_Posts {
	
	public function widget( $args, $instance ) {		

		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : '';

		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
		if ( ! $number )
			$number = 5;
		$show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;

		/**
		 * Filter the arguments for the Recent Posts widget.
		 *
		 * @since 3.4.0
		 *
		 * @see WP_Query::get_posts()
		 *
		 * @param array $args An array of arguments used to retrieve the recent posts.
		 */
		$r = new WP_Query( apply_filters( 'widget_posts_args', array(
			'posts_per_page'      => $number,
			'no_found_rows'       => true,
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true
		) ) );

		if ($r->have_posts()) :
		?>
		<?php echo $args['before_widget']; ?>
		<?php if ( $title ) {
			echo $args['before_title'] . esc_html($title) . $args['after_title'];
		} ?>
		<div class="row">
		<?php while ( $r->have_posts() ) : $r->the_post(); 
			$categories = sam_martin_post_taxonomy( get_the_ID() ,get_post_type());
		?>
			<div class="recent-post mb-30 col-lg-3 col-md-6 col-sm-6 col-xx-12 col-xs-6 ">
				<div class="blog-block <?php if(!has_post_thumbnail()){echo 'blog-no-image';}?>">
					<div class="blog-image recent-post-image">
					<?php if ( has_post_thumbnail() ) {
							the_post_thumbnail('sam-martin-post-thumbnails');
						} ?>
						<?php if ( $show_date ) : ?>
						<div class="blog-date"><span><?php echo date('M, d',strtotime(get_the_date()));?></span></div>
						<?php endif; ?>
					</div>
					<div class="blog-info">
						<div class="blog-meta">
							<p><span class="ti-comment-alt"></span> <a href="<?php echo esc_url(get_permalink().'#comments');?>"><?php echo get_comments_number();?></a></p>
							<p><span class="ti-user"></span><?php the_author_posts_link()?></p>
							<?php if(!empty($categories)):?>
							<p><span class="ti-folder"></span> 
								<?php $i=1; foreach($categories as $category):?>
									<a href="<?php echo esc_url(get_term_link( $category));?>"><?php echo esc_attr($category->name);?></a>
									<?php echo ($i!=sizeof($categories))? ', ': '';?>
								<?php $i++; endforeach;?>
							</p>
							<?php endif;?>
						</div>
						<div class="recent-post-info blog-content">
							<a class="recent-post-title" href="<?php the_permalink(); ?>"><?php get_the_title() ? the_title() : the_ID(); ?></a>
							<?php the_excerpt()?>
						
							<div class="blog-bottom clearfix">
								<div class="button-small"><a href="<?php the_permalink()?>"><?php esc_html_e('Read More..','smtf');?></a></div>
								<?php do_action('sammartin_social_share',get_the_ID());?>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php endwhile; ?>
		</div>
		<?php echo $args['after_widget']; ?>
		<?php
		// Reset the global $the_post as this query will have stomped on it
		wp_reset_postdata();

		endif;
	}
}
register_widget('WP_sam_martin_Recent_Posts');
?>