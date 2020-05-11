<div class="bg-white col-lg-3 col-md-4 col-6 grid__item mb-30px
<?php $terms = get_the_terms( get_the_ID(), 'estado' );
if ( $terms && ! is_wp_error( $terms ) ) :
	?> <?php
	foreach ( $terms as $term ) {
		echo ' estado-'.esc_html($term->term_id);
	}
endif;
?>
<?php $terms = get_the_terms( get_the_ID(), 'tipo' );
if ( $terms && ! is_wp_error( $terms ) ) :
	?> <?php
	foreach ( $terms as $term ) {
		echo ' tipo-'.esc_html($term->term_id);
	}
endif;
?>
<?php $terms = get_the_terms( get_the_ID(), 'fundo' );
if ( $terms && ! is_wp_error( $terms ) ) :
	?> <?php
	foreach ( $terms as $term ) {
		echo ' fundo-'.esc_html($term->term_id);
	}
endif;
?>" >
    <div class="portfolio scrollpop slide-up poponce <?php if (get_field('logo')) echo 'portfolio--hasimage' ?>" >
      <a class="portfolio__image mb-3 d-block" href="<?php the_permalink() ?>" data-toggle="modal" data-target="#modal" data-modal-id="<?php echo get_the_ID(); ?>" >
				<?php smart_image(get_post_thumbnail_id(),'large','portfolio__image--bg p-absolute nobg o-10','fade') ?>
				<?php smart_image(get_field('logo'),'large','contain w-100 nobg ','fade') ?>
			</a>
      <div class="portfolio__body">

        <div class="portfolio__body__excerpt text-dk-grey"><?php the_excerpt() ?></div>
      </div>
      <button data-toggle="modal" data-target="#modal" data-modal-id="<?php echo get_the_ID(); ?>" class="btn btn-link scrollpop portfolio__link" ><?php echo __('detalhes','penumbra') ?></button>
    </div>
</div>
