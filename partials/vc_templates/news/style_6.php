<?php

if (!$img_size) {
    $img_size = 'consulting-image-350x250-croped';
}


if (stm_check_layout('layout_13')) {
    $img_size = 'consulting-image-320x320-croped';
}

$style_class = '';

if (empty($style)) {
    $style = 'style_1';
}

if (!empty($style) and $style == 2) {
    $style_class = 'style_2';
}
if(!empty($disable_preview_image)) {
    $style_class .= ' disable-preview';
}

$settings = array(
    'img_size' => $img_size,
    'posts_per_row' => $posts_per_row,
    'css_class' => $css_class
);

$i = 0;
?>

<?php if ($query->have_posts()): ?>

    <div class="stm_news <?php echo esc_attr($style_class);
    echo esc_attr($css_class); ?>">
        <ul class="news_list posts_per_row_<?php echo esc_attr($posts_per_row); ?>">

            <?php while ($query->have_posts()): $query->the_post(); ?>

                <?php
                set_query_var('img_size', $img_size);
                if( empty( $img_size ) ) {
                    $img_size = '720x500';
                }
                ?>
                <li class="view_style_6">
                    <div class="post-item">
                        <?php if( has_post_thumbnail() ): ?>
                            <div class="img-wrap">
                                <a href="<?php the_permalink(); ?>">
                                    <?php echo consulting_get_image( get_post_thumbnail_id(), $img_size ); ?>
                                </a>
                                <div class="date-wrap third_bg_color">
                                    <?php echo get_the_date(); ?>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="post-info">
                            <div class="post-title">
                                <h4>
                                    <a href="<?php the_permalink(); ?>" class="third_font_color_hv">
                                        <?php the_title(); ?>
                                    </a>
                                </h4>
                            </div>
                            <?php if( has_excerpt() ): ?>
                                <div class="post-excerpt">
                                    <?php echo get_the_excerpt(); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </li>
                <?php endwhile; ?>
        </ul>
    </div>
<?php
endif;
wp_reset_postdata(); ?>