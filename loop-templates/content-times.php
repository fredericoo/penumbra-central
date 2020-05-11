<div class="container-fluid px-0"><?php smart_image(get_post_thumbnail_id(),'huge','', 'zoom-fade poponce ms-200'); ?></div>
<div class="container my-5">
	<div class="row">
		<div class="col-lg-8">
			<svg class="deco ml-n3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 213.313 137.178">
				<polygon class="fill-light scrollpop poponce slide ms-300" points="173.812 0 213.313 0 150.829 137.178 111.328 137.178 173.812 0"/>
				<polygon class="fill-light scrollpop poponce slide" points="118.401 0 157.901 0 95.417 137.178 55.916 137.178 118.401 0"/>
				<polygon class="fill-light scrollpop poponce slide ms-200" points="62.484 0 101.985 0 39.501 137.178 0 137.178 62.484 0"/>
			</svg>
			<h1 class="mt-2 display-2 scrollpop poponce fade ms-200 p-relative"><?php the_title(); ?></h1>
			<?php the_content(); ?>
		</div>
	</div>

	<?php

// check if the repeater field has rows of data
if( have_rows('jogadores') ):
	?> <div class="row"> <?php
 	// loop through the rows of data
    while ( have_rows('jogadores') ) : the_row();
			?>
			<div class="col-lg-4 col-md-6 mb-30px">

				<div class="card jogador">
					<?php smart_image((get_sub_field('foto') ? get_sub_field('foto') : 68),'huge','card-img', 'zoom-fade poponce ms-200'); ?>
					<div class="card-sheet-overlay">

					</div>

					<div class="card-img-overlay text-white">
						<h4 class="jogador__numero"><?php the_sub_field('numero'); ?></h4>
				  </div>

					<div class="card-img-overlay pl-4" style="bottom: 0; top: auto;">
						<p class="mb-0 jogador__posicao text-secondary"><?php the_sub_field('posicao') ?></p>
				    <h2 class="jogador__nome text-white"><?php the_sub_field('nome') ?></h2>
				  </div>
				</div>


			</div>
			<?php
        // display a sub field value

    endwhile;
		?> </div> <?php
else :

    // no rows found

endif;

?>

	</div>
</div>
