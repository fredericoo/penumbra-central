<section class="my-5 py-5"><div class="container px-0">
    <div class="row">
      <div class="col-md-4">
        <?php smart_image(get_post_thumbnail_id(),'large','p-absolute nobg h-100 pb-0','fade pop') ?>
      </div>
      <div class="col-md-8">
        <div class="p-3"><?php //smart_image(get_field('logo'),'large','nobg','fade pop') ?>
          <h1><?php the_title() ?></h1>
          <div class="text-dk-grey"><?php the_content() ?></div>

          <table class="table table-borderless table-striped">
            <tbody>


                <?php $terms = get_the_terms( get_the_ID(), 'tipo' );
                if ( $terms && ! is_wp_error( $terms ) ) :
                  ?>
                  <tr>
                  <th scope="row"><?php echo __('Tipo','penumbra') ?></th><?php
                  foreach ( $terms as $term ) {
                    echo '<td>'.esc_html($term->name).'</td>';
                  } ?>
                </tr>
                <?php endif;
                ?>

                <?php if (get_field('localizacao')): ?>
                  <tr>
                    <th scope="row"><?php echo __('Localização','penumbra') ?></th>
                    <td><?php the_field('localizacao') ?></td>
                  </tr>
                <?php endif; ?>

                <?php $terms = get_the_terms( get_the_ID(), 'estado' );
                if ( $terms && ! is_wp_error( $terms ) ) :
                  ?>
                  <tr>
                  <th scope="row"><?php echo __('Estado','penumbra') ?></th><?php
                  foreach ( $terms as $term ) {
                    echo '<td>'.esc_html($term->name).'</td>';
                  } ?>
                </tr>
                <?php endif;
                ?>

                <?php $terms = get_the_terms( get_the_ID(), 'fundo' );
                if ( $terms && ! is_wp_error( $terms ) ) :
                  ?>
                  <tr>
                  <th scope="row"><?php echo __('Fundo','penumbra') ?></th><?php
                  foreach ( $terms as $term ) {
                    echo '<td>'.esc_html($term->name).'</td>';
                  } ?>
                </tr>
                <?php endif;
                ?>

                <?php if (get_field('ano')): ?>
                  <tr>
                    <th scope="row"><?php echo __('Ano de investimento','penumbra') ?></th>
                    <td><?php the_field('ano') ?></td>
                  </tr>
                <?php endif; ?>

                <tr>
                  <td colspan="2">
                    <?php

                    // check if the repeater field has rows of data
                    if( have_rows('redes') ):

                       // loop through the rows of data
                        while ( have_rows('redes') ) : the_row();

                            ?>
                            <a href="<?php the_sub_field('link'); ?>" target="_blank" class="btn btn-outline-primary"><span class="mdi <?php the_sub_field('mdi'); ?>"></span></a>
                            <?php
                        endwhile;

                    else :

                        // no rows found

                    endif;

                    ?>
                  </td>
                </tr>

            </tbody>
          </table>

          </div>
      </div>
    </div>
  </div>
  </section>
