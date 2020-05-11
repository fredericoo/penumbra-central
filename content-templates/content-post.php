<section class="single-post pt-navbar" data-next-post="<?php echo (get_previous_post()->ID ?: '-1'); ?>">
	<div class="single-post__image vh-50 bg-primary"><?php smart_image(get_post_thumbnail_id(),'huge','w-100 vh-90 pb-0','fade'); ?></div>
	<div class="container pt-5 align-self-end">
		<div class="row">
			<div class="single-post__box col-lg-10 bg-white mx-auto scrollpop slide-up poponce">
				<div class="single-post__header scrollpop slide-up ms-100 poponce">
					<timestamp class="single-post__date"><?php echo get_the_date(); ?></timestamp>
					<h1><?php the_title() ?></h1>
					<div class="row single-post__meta">
						<div class="mb-3 col-md-4 col-6">
							<dt><?php echo __('autor','penumbra') ?></dt>
							<dd><?php echo get_the_author_meta( 'display_name'); ?></dd>
						</div>
						<div class="mb-3 col-md-4 col-6">
							<dt><?php echo __('leitura','penumbra'); ?></dt>
							<dd><?php echo read_time(); ?></dd>
						</div>
						<div class="mb-3 col-md-4 ">
							<?php penumbra_share() ?>
						</div>
					</div>
				</div>
				<div class="single-post__content">
					<?php the_content() ?>
					<?php if (is_admin()) { ?>
						<a href="<?php echo get_edit_post_link()  ?>" class="btn btn-secondary">Editar post</a>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</section>
