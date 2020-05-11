<div class="container-fluid px-0 bg-<?php the_sub_field('bg');?> my-<?php the_sub_field('my'); ?>" >

	<div class="container<?php echo (get_sub_field('full-width') == 1 ? '-fluid px-0' : '') ?>" >
		<div class="row">
			<div class="
			<?php
			switch (get_sub_field('size')) {
				case 'small';
				echo 'col-lg-4 col-md-6 col-10';
				break;
				case 'medium';
				echo 'col-lg-6 col-md-8 col-12';
				break;
				case 'large';
				echo 'col-12';
				break;
			}
			?> mx-auto">

			<?php smart_image( get_sub_field('imagem'), 'huge', '', 'fade poponce'); ?>

		</div>
	</div>
</div>
</div>
