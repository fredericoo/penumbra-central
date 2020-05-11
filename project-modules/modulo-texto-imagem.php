
  <div class="container my-<?php the_sub_field('my'); ?>">
	  <div class="row">
		  <div class="col-md-6 my-3 order-md-2">

		   <?php smart_image( get_sub_field('imagem'), 'huge', '', 'fade poponce'); ?>

		  </div>
		  <div class="col-md-6 my-3 order-md-1">

		   <div class="sticky-top"><?php the_sub_field('texto'); ?></div>

		  </div>
	  </div>
  </div>
