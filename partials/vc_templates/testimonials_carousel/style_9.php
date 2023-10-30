<?php
/**
 * @var $css_class
 * @var $count
 * @var $category
 * @var $per_row
 * @var $disable_carousel
 * @var $disable_image
 * @var $link
 * @var $disable_carousel_arrows
 */

wp_enqueue_script( 'slick' );
wp_enqueue_style( 'slick' );

if ( ! empty( $style ) ) {
	$css_class .= ' ' . esc_attr( $style );
}

$args = array(
	'post_type'      => 'stm_testimonials',
	'posts_per_page' => $count,
);

if ( 'all' !== $category ) {
	$args['stm_testimonials_category'] = $category;
}

if ( $per_row ) {
	$css_class .= ' per_row_' . $per_row;
} else {
	$per_row = 1;
}

if ( $disable_carousel ) {
	$css_class .= ' disable_carousel';
}

if ( empty( $thumb_size ) ) {
	$thumb_size = '350x350';
}

$testimonials = new WP_Query( $args );
$slider_id    = uniqid( 'partners_carousel_' );

$autoplay_carousel_js = 'false';

if ( ! empty( $autoplay_carousel ) && 'yes' === $autoplay_carousel ) {
	$autoplay_carousel_js = 'true';
}

if ( ! empty( $colorpicker ) ) {
	$text_color = 'style=color:' . $colorpicker;
} else {
	$text_color = '';
}
?>
<?php if ( $testimonials->have_posts() ) : ?>
	<div class="<?php echo esc_attr( $css_class ); ?>" id="<?php echo esc_attr( $slider_id ); ?>">
		<?php
		while ( $testimonials->have_posts() ) :
			$testimonials->the_post();
			?>
			<div class="testimonial">
				<div class="testimonial-inner">
					<div class="testimonial-text" <?php echo esc_attr( $text_color ); ?>><?php the_excerpt(); ?></div>
					<div class="testimonial-info">
						<div class="testimonial-bottom">
							<div class="name">
								<?php if ( $link['url'] ) : ?>
									<a href="<?php echo esc_url( $link['url'] ); ?>">
								<?php endif; ?>
									<?php the_title(); ?>
								<?php if ( $link['url'] ) : ?>
									</a>
								<?php endif; ?>
							</div>
							<div class="company">
								<?php
								$position = get_post_meta( get_the_ID(), 'testimonial_position', true );
								if ( $position ) {
									echo esc_html( $position ) . ', ';
								}
								echo esc_html( get_post_meta( get_the_ID(), 'testimonial_company', true ) );
								?>
							</div>
						</div>
						<?php if ( ! $disable_image && has_post_thumbnail() ) : ?>
							<div class="testimonial-image"><?php the_post_thumbnail( 'consulting-image-320x320-croped' ); ?></div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		<?php endwhile; ?>
	</div>
	<?php if ( ! $disable_carousel ) : ?>
		<script type="text/javascript">
			jQuery(document).ready(function ($) {
				"use strict";
				var <?php echo esc_attr( $slider_id ); ?> =
				$("#<?php echo esc_attr( $slider_id ); ?>");
				var slickRtl = false;

				if ($('body').hasClass('rtl')) {
					slickRtl = true;
				}

				<?php echo esc_attr( $slider_id ); ?>.
				slick({
					rtl: slickRtl,
					dots: 'false',
					infinite: true,
					arrows: <?php echo ( ! $disable_carousel_arrows ) ? 'true' : 'false'; ?>,
					prevArrow:"<div class=\"slick_prev\"><i class=\"fa fa-chevron-left\"></i></div>",
					nextArrow: "<div class=\"slick_next\"><i class=\"fa fa-chevron-right\"></i></div>",
					autoplaySpeed: 5000,
					autoplay: <?php echo esc_js( $autoplay_carousel_js ); ?>,
					slidesToShow: <?php echo esc_js( $per_row ); ?>,
					cssEase: "cubic-bezier(0.455, 0.030, 0.515, 0.955)",
					responsive: [
						{
							breakpoint: 769,
							settings: {
								slidesToShow: 1
							}
						}
					]
				});
			});
		</script>
	<?php endif; ?>
<?php endif; ?>
<?php wp_reset_postdata(); ?>
