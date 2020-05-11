<div class="container-fluid bg-very-light py-5 my-<?php the_sub_field('my'); ?>">
	<div class="container">
		<div class="row">
			<div class="<?php if (get_sub_field('imagem2')) { ?> col-lg-8 align-self-center<?php } else { ?> col-lg-10 <?php } ?> my-3 my-md-1 mx-auto">
				<div class="screenshot">
					<div class="screenshot-btn"></div>
					<div class="screenshot-btn"></div>
					<div class="screenshot-btn"></div>

					<?php $file_url = wp_get_attachment_url( get_sub_field('imagem') );
								$filetype = wp_check_filetype( $file_url );
								if (preg_match("/video/i", $filetype['type'])) { ?>
					<div class="screenshot-content video">

						<video height="1080" width="1920" poster="<?php echo wp_get_attachment_image_src( get_field('cover', get_sub_field('imagem')), 'large' )[0]; ?>" autoplay="" loop="" muted="">
						        <source src="<?php echo $file_url; ?>">
						        <p class="warning">Seu navegador não suporta vídeos html5.</p>
						</video>
						<?php } else { ?>
							<div class="screenshot-content">
						<?php smart_image( get_sub_field('imagem'), 'huge', '', 'fade poponce'); ?>
						<?php } ?>
					</div>
				</div>
			</div>
			<?php if (get_sub_field('imagem2')) { ?>
			<div class="col-md-3 col-8 my-3 my-md-1 mx-auto">
				<div class="screenshot-m">
					<div class="screenshot-notch"></div>
					<div class="screenshot-content"><?php smart_image( get_sub_field('imagem2'), 'huge', '', 'fade poponce'); ?></div>
				</div>
			</div>
			<?php } ?>
		</div>
	</div>
</div>
