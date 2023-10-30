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

wp_enqueue_script('isotope');
wp_enqueue_script('packery');
wp_enqueue_script('imagesloaded');

$i = 0;
?>

<?php if ($query->have_posts()): ?>

    <div class="stm_news <?php echo esc_attr($style_class);
    echo esc_attr($css_class); ?>">
        <ul class="news_list posts_per_row_<?php echo esc_attr($posts_per_row); ?><?php if($view_style == 'style_4') : ?> news-masonry<?php endif; ?>">

            <?php while ($query->have_posts()): $query->the_post(); ?>

                <?php
                set_query_var('i', $i);
                ?>
                <?php
                $image_size = '360x250';
                if( $i === 1 || ( ( ( ( $i + 1 ) % 3 ) === 0 ) && $i !== 2 ) ) {
                    $image_size = '360x403';
                }
                elseif( $i === 2 || ( ( $i + 2 ) % 3 ) === 0 ) {
                    $image_size = '360x283';
                }
                $attachment_id = get_post_thumbnail_id( get_the_ID() );
                if( !empty( $attachment_id ) ) {
                    $thumbnail = consulting_get_image($attachment_id, $image_size);
                }
                $post_url = get_the_permalink();
                ?>
                <?php if( has_post_thumbnail() ): ?>
                    <li class="view_style_4 news_item">
                        <div class="post_item">
                            <a href="<?php echo esc_url( $post_url ); ?>" class="image">
                                <div class="post_date third_bg_color base_font_color">
                                    <?php echo get_the_date(); ?>
                                </div>
                                <?php
                                echo wp_kses_post( $thumbnail );
                                ?>
                                <h5><?php the_title(); ?></h5>
                            </a>
                        </div>
                    </li>
                <?php endif; ?>
                <?php $i++; ?>

            <?php endwhile; ?>
        </ul>
    </div>
<?php
endif;
wp_reset_postdata(); ?>

<script type="text/javascript">
    jQuery(document).ready(function ($) {
        var $container = $(".stm_news .news_list.news-masonry");
        var originLeft = true;
        if ($("body").hasClass("rtl")) {
            originLeft = false;
        }
        $container.isotope({
            layoutMode: "packery",
            itemSelector: ".news_item.view_style_4",
            transitionDuration: "0.7s",
            gutter: 10,
            isOriginLeft: originLeft,
        });
        $container.imagesLoaded().progress(function () {
            $container.isotope("layout");
        });
        $container.isotope("layout");

    });
</script>
