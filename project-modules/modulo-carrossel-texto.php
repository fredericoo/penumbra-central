
  <div class="container my-<?php the_sub_field('my'); ?>">
	  <div class="row">
		  <div class="col-md-6 my-3">

				<div class="main-carousel" data-flickity='{"cellAlign": "center", "contain": false}'>
 		 		<?php
 		 			$images = get_sub_field('imagens');
 		 			$size = 'large'; // (thumbnail, medium, large, full or custom size)
 		 		?>
 		 		<?php foreach( $images as $image ): ?>
 		 			<div class="carousel-cell">
 		 				<?php smart_image( $image['ID'], $size,'pb-0 contain'); ?>
 		 			</div>
 		 		<?php endforeach; ?>
 		   </div>

		  </div>
		  <div class="col-md-6 my-3">

		   <?php the_sub_field('texto'); ?>

		  </div>
	  </div>
  </div>
