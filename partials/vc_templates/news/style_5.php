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
                if (empty($img_size)) {
                    $img_size = '360x190';
                }
                $attachment_id = get_post_thumbnail_id(get_the_ID());
                if (!empty($attachment_id)) {
                    $thumbnail = consulting_get_image($attachment_id, $img_size);
                }
                $post_url = get_the_permalink();
                ?>
                <li class="view_style_5 news_item">
                    <div class="post_item">
                        <?php if (has_post_thumbnail()): ?>
                            <a href="<?php echo esc_url($post_url); ?>" class="image">
                                <?php echo wp_kses_post($thumbnail); ?>
                            </a>
                        <?php endif; ?>
                        <a href="<?php echo esc_url( $post_url ); ?>" class="title base_font_color">
                            <h5 class="secondary_font_color_hv"><?php the_title(); ?></h5>
                        </a>
                        <a href="<?php echo esc_url( $post_url ); ?>" class="read_more_arrow base_font_color">
                            <i class="stm-lnr-arrow-right"></i>
                            <?php esc_html_e('Read more', 'consulting'); ?>
                        </a>
                    </div>
                </li>
                <?php $i++; ?>

            <?php endwhile; ?>
        </ul>
    </div>
<?php
endif;
wp_reset_postdata(); ?>