<div class="mtm-project col-sm-6 col-lg-4  scrollpop slide-up vh-md-70 d-flex flex-column justify-content-end my-4">

	<a class="mtm-project__link" data-post-id="<?php echo get_the_ID() ?>" href="<?php the_permalink() ?>" >
	<?php smart_image(get_post_thumbnail_id(),'large','nobg','poponce fade'); ?>
				<h3 class="mtm-project__title"><?php the_title(); ?></h3>
				<div class="mtm-project__location"><span><?php the_field('local') ?></span></div>
				</a>
</div>
