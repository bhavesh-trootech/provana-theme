<li id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( has_post_thumbnail() ) { ?>
		<div class="post_thumbnail"><a href="<?php the_permalink(); ?>">
	  	<?php 
	echo get_the_post_thumbnail( get_the_ID(), 'consulting-image-350x204-croped' ); 
	  	?>
		<?php echo $textimg; ?></a>
		</div>
	<?php } else {
		$imgg=get_site_url().'/wp-content/uploads/2020/06/placeholder-20.gif';
		?>  
		
		<div class="post_thumbnail"><a href="<?php the_permalink(); ?>">
	  	<img width="350" height="204" src="<?php echo $imgg;?>" 
		class="attachment-consulting-image-350x204-croped size-consulting-image-350x204-croped wp-post-image" alt="AdobeStock_272835623" />		
	   </a>
		</div>
		 <?php  } ?>
		 <?php 
		 $categories = get_the_category( get_the_ID());

	
		if(!empty( $categories)) {
		 ?>
		   <div class="category">
                                    <a href="<?php echo esc_url( get_category_link( $categories[0]->term_id ) ); ?>">
                                        <span><?php echo $categories[0]->name; ?></span>
                                        <i class="fa fa-chevron-right"></i>
                                    </a>
                                </div>
			<?php }else {

				$categoriesv = get_the_category( get_the_ID(),'newcategory');
				if(!empty($categoriesv)) { ?>
								<div class="category">
                                    <a href="<?php echo esc_url( get_category_link( $categoriesv[0]->term_id ) ); ?>">
                                        <span><?php echo $categoriesv[0]->name; ?></span>
                                        <i class="fa fa-chevron-right"></i>
                                    </a>
                                </div>
				<?php }


			} ?>					
	<h5><a href="<?php the_permalink(); ?>" class="secondary_font_color_hv"><?php the_title(); ?></a></h5>
	<div class="post_date"><i class="fa fa-clock-o"></i> <?php echo get_the_date(); ?></div>
</li>

