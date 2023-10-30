<?php
/**
 * @var $img_size
 * @var $posts_per_row
 * @var $css_class
 * @var $query
 */

if ( ! $img_size ) {
	$img_size = 'consulting-image-350x250-croped';
}

$style_class = '';

if ( empty( $style ) ) {
	$style = 'style_1';
}

if ( ! empty( $style ) && 2 === $style ) {
	$style_class = 'style_2';
}

if ( ! empty( $disable_preview_image ) ) {
	$style_class .= ' disable-preview';
}

$settings = array(
	'img_size'      => $img_size,
	'posts_per_row' => $posts_per_row,
	'css_class'     => $css_class,
);

$i = 0;

$len = 110;
?>

<?php if ( $query->have_posts() ) : ?>
	<div class="stm_news <?php echo esc_attr( $style_class ); ?> <?php echo esc_attr( $css_class ); ?>">
		<ul class="news_list posts_per_row_<?php echo esc_attr( $posts_per_row ); ?>">
			<?php
			while ( $query->have_posts() ) :
				$query->the_post();
				?>
				<li class="view_style_8">
					<div class="post_inner">
						<?php if ( has_post_thumbnail() && ! $disable_preview_image ) : ?>
							<div class="post_image">
								<a href="<?php the_permalink(); ?>">
									<?php
									$attachment_id = get_post_thumbnail_id( get_the_ID() );
									$thumbnail     = consulting_get_image( $attachment_id, $img_size );
									echo wp_kses_post( $thumbnail );
									?>
								</a>
							</div>
						<?php endif; ?>
						<div class="post_bottom">
							<h5>
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</h5>
							<?php if ( has_excerpt() ) : ?>
								<div class="post_excerpt">
									<p>
										<?php echo esc_html( consulting_substr_text( get_the_excerpt(), $len ) ); ?>
									</p>
								</div>
							<?php endif; ?>

							<div class="post_info">
								<div class="post_date">
									<i class="fa fa-calendar"></i>
									<span><?php echo get_the_date( 'M j, Y' ); ?></span>
								</div>
								<div class="post_comments">
									<a href="<?php comments_link(); ?>"><i class="fa fa-comment-o"></i><?php comments_number(); ?> </a>
								</div>
							</div>
						</div>
					</div>
				</li>
			<?php endwhile; ?>
		</ul>
	</div>
	<?php
endif;
wp_reset_postdata(); ?>
