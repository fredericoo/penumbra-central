<div class="membro-equipe grid__item col-6 col-md-4 col-lg-3 text-center mb-30px px-0">
	<a href="<?php the_permalink() ?>" data-toggle="modal" data-target="#modal" data-modal-id="<?php echo get_the_ID(); ?>" >
		<div class="membro-equipe__avatar bg-dk-grey"><?php smart_image(get_post_thumbnail_id(),'large','nobg  ','fade poponce'); ?></div>
		<h3 class="membro-equipe__titulo"><?php the_title(); ?></h3>
		<figcaption class="membro-equipe__cargo"><?php the_field('cargo') ?></figcaption>
	</a>
</div>
