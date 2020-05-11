<section class="section section--head d-flex flex-column justify-content-end mb-n5 pt-5 mt-5 p-relative">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 col-12 mx-auto scrollpop slide-up">
        <h1 class="display-2 mb-5"><?php the_title() ?></h1>
      </div>
      <div class="col-lg-6 col-md-8 col-10 mx-auto mb-n5 bg-white scrollpop slide-up ms-200">
        <div class="p-3 p-lg-5"><?php the_content() ?></div>
      </div>
    </div>
  </div>

</section>

<?php smart_image(get_post_thumbnail_id(),'huge','negative z-down pb-0 vh-80','fade') ?>

<?php

// check if the repeater field has rows of data
if( have_rows('modulos') ): ?>

<section>
  <div class="container">
    <div class="row">
      <div class="col-lg-10 offset-lg-1 p-relative" data-spy="scroll" data-target=".indice" data-offset="50">
        <div class="row grid grid--quem-somos mt-5 grid--packery">
          <aside class="grid-sizer col-1"></aside>
          <?php $i == 0; while ( have_rows('modulos') ) : the_row(); $i++; ?>
            <div class="grid__item col-md-6 mb-30px" id="indice<?php echo $i; ?>">
              <div class="grid__item-box scrollpop slide-up poponce">
                <h2 class="text-primary"><?php the_sub_field('titulo') ?></h2>
                <div class="w-25"><?php smart_image(get_sub_field('imagem'),'huge','nobg','fade'); ?></div>
                <?php the_sub_field('texto') ?>
              </div>
            </div>
          <?php endwhile; ?>
        </div>

        <?php
        if( have_rows('metricas') ): ?>

        <aside class="numbers my-5">
          <h2 class="mb-5 display-2"><?php the_field('socios_titulo') ?></h2>
          <div class="row scrollpop slide-up-children">

        <?php  while ( have_rows('metricas') ) : the_row(); ?>

          <div class="col-md-4 text-center my-3">
            <h3 class="odometer display-1 text-secondary"><?php the_sub_field('numero') ?></h3>
            <p><?php the_sub_field('texto') ?></p>
          </div>

        <?php endwhile; ?>
      </div>
    </aside>

        <?php endif; ?>

      </div>
    </div>
  </div>
</section>

<?php endif; ?>

<section id="section-founders" class="section section--founders mb-5">

  <div class="container">
    <div class="row">

      <div class="col-md-6 extend-md-right pl-md-0 order-md-2">
        <svg version="1.1" class="mb-5" id="dot-pattern" x="0px" y="0px"
           viewBox="0 0 512 58" style="enable-background:new 0 0 512 58;" xml:space="preserve">
          <g>
            <polygon class="fill-secondary proximity-scale" data-proximity="1.0" points="195.6,24.6 191.5,28.7 195.6,32.8 199.8,28.7     "/>
            <polygon class="fill-primary proximity-scale" data-proximity="0.5" points="112.9,25 109.2,28.7 112.9,32.5 116.7,28.7     "/>
            <polygon class="fill-primary proximity-scale" data-proximity="0.5" points="12.2,25 8.5,28.7 12.2,32.5 16,28.7     "/>
            <polygon class="fill-secondary proximity-scale" data-proximity="1.0" points="62.6,24.6 58.5,28.7 62.6,32.8 66.7,28.7     "/>
            <polygon class="fill-white" points="213.8,8.9 212.4,7.5 211,8.9 212.4,10.3     "/>
            <polygon class="fill-white" points="195.6,7.5 194.2,8.9 195.6,10.3 197,8.9     "/>
            <polygon class="fill-white" points="178.9,7.5 177.5,8.9 178.9,10.3 180.3,8.9     "/>
            <polygon class="fill-white" points="162.1,7.5 160.7,8.9 162.1,10.3 163.5,8.9     "/>
            <polygon class="fill-white" points="146.5,7.5 145.1,8.9 146.5,10.3 147.9,8.9     "/>
            <polygon class="fill-white" points="129.7,7.5 128.3,8.9 129.7,10.3 131.1,8.9     "/>
            <polygon class="fill-white" points="112.9,7.5 111.5,8.9 112.9,10.3 114.3,8.9     "/>
            <polygon class="fill-white" points="96.1,7.5 94.7,8.9 96.1,10.3 97.5,8.9     "/>
            <polygon class="fill-white" points="79.4,7.5 78,8.9 79.4,10.3 80.8,8.9     "/>
            <polygon class="fill-white" points="62.6,7.5 61.2,8.9 62.6,10.3 64,8.9     "/>
            <polygon class="fill-white" points="45.8,7.5 44.4,8.9 45.8,10.3 47.2,8.9     "/>
            <polygon class="fill-white" points="29,7.5 27.6,8.9 29,10.3 30.4,8.9     "/>
            <polygon class="fill-white" points="12.2,7.5 10.8,8.9 12.2,10.3 13.6,8.9     "/>
            <polygon class="fill-white" points="213.8,48.2 212.4,46.8 211,48.2 212.4,49.6     "/>
            <polygon class="fill-white" points="195.6,46.8 194.2,48.2 195.6,49.6 197,48.2     "/>
            <polygon class="fill-white" points="178.9,46.8 177.5,48.2 178.9,49.6 180.3,48.2     "/>
            <polygon class="fill-white" points="162.1,46.8 160.7,48.2 162.1,49.6 163.5,48.2     "/>
            <polygon class="fill-white" points="146.5,46.8 145.1,48.2 146.5,49.6 147.9,48.2     "/>
            <polygon class="fill-white" points="129.7,46.8 128.3,48.2 129.7,49.6 131.1,48.2     "/>
            <polygon class="fill-white" points="112.9,46.8 111.5,48.2 112.9,49.6 114.3,48.2     "/>
            <polygon class="fill-white" points="96.1,46.8 94.7,48.2 96.1,49.6 97.5,48.2     "/>
            <polygon class="fill-white" points="79.4,46.8 78,48.2 79.4,49.6 80.8,48.2     "/>
            <polygon class="fill-white" points="62.6,46.8 61.2,48.2 62.6,49.6 64,48.2     "/>
            <polygon class="fill-white" points="45.8,46.8 44.4,48.2 45.8,49.6 47.2,48.2     "/>
            <polygon class="fill-white" points="29,46.8 27.6,48.2 29,49.6 30.4,48.2     "/>
            <polygon class="fill-white" points="12.2,46.8 10.8,48.2 12.2,49.6 13.6,48.2     "/>
            <polygon class="fill-white" points="213.8,28.7 212.4,27.3 211,28.7 212.4,30.1     "/>
            <polygon class="fill-white" points="178.9,27.3 177.5,28.7 178.9,30.1 180.3,28.7     "/>
            <polygon class="fill-white" points="162.1,27.3 160.7,28.7 162.1,30.1 163.5,28.7     "/>
            <polygon class="fill-white" points="146.5,27.3 145.1,28.7 146.5,30.1 147.9,28.7     "/>
            <polygon class="fill-white" points="129.7,27.3 128.3,28.7 129.7,30.1 131.1,28.7     "/>
            <polygon class="fill-white" points="96.1,27.3 94.7,28.7 96.1,30.1 97.5,28.7     "/>
            <polygon class="fill-white" points="79.4,27.3 78,28.7 79.4,30.1 80.8,28.7     "/>
            <polygon class="fill-white" points="45.8,27.3 44.4,28.7 45.8,30.1 47.2,28.7     "/>
            <polygon class="fill-white" points="29,27.3 27.6,28.7 29,30.1 30.4,28.7     "/>
            <polygon class="fill-secondary proximity-scale" data-proximity="1.0" points="499.4,24.6 495.3,28.7 499.4,32.8 503.5,28.7     "/>
            <polygon class="fill-primary proximity-scale" data-proximity="0.5" points="416.7,25 412.9,28.7 416.7,32.5 420.5,28.7     "/>
            <polygon class="fill-primary proximity-scale" data-proximity="0.5" points="316,25 312.2,28.7 316,32.5 319.8,28.7     "/>
            <polygon class="fill-secondary proximity-scale" data-proximity="1.0" points="366.3,24.6 362.2,28.7 366.3,32.8 370.5,28.7     "/>
            <polygon class="fill-secondary proximity-scale" data-proximity="1.0" points="265.6,24.6 261.5,28.7 265.6,32.8 269.8,28.7     "/>
            <polygon class="fill-white" points="499.4,7.5 498,8.9 499.4,10.3 500.8,8.9     "/>
            <polygon class="fill-white" points="482.6,7.5 481.2,8.9 482.6,10.3 484,8.9     "/>
            <polygon class="fill-white" points="465.8,7.5 464.4,8.9 465.8,10.3 467.2,8.9     "/>
            <polygon class="fill-white" points="450.3,7.5 448.9,8.9 450.3,10.3 451.6,8.9     "/>
            <polygon class="fill-white" points="433.5,7.5 432.1,8.9 433.5,10.3 434.9,8.9     "/>
            <polygon class="fill-white" points="416.7,7.5 415.3,8.9 416.7,10.3 418.1,8.9     "/>
            <polygon class="fill-white" points="399.9,7.5 398.5,8.9 399.9,10.3 401.3,8.9     "/>
            <polygon class="fill-white" points="383.1,7.5 381.7,8.9 383.1,10.3 384.5,8.9     "/>
            <polygon class="fill-white" points="366.3,7.5 364.9,8.9 366.3,10.3 367.7,8.9     "/>
            <polygon class="fill-white" points="349.6,7.5 348.2,8.9 349.6,10.3 351,8.9     "/>
            <polygon class="fill-white" points="332.8,7.5 331.4,8.9 332.8,10.3 334.2,8.9     "/>
            <polygon class="fill-white" points="316,7.5 314.6,8.9 316,10.3 317.4,8.9     "/>
            <polygon class="fill-white" points="299.2,7.5 297.8,8.9 299.2,10.3 300.6,8.9     "/>
            <polygon class="fill-white" points="282.4,7.5 281,8.9 282.4,10.3 283.8,8.9     "/>
            <polygon class="fill-white" points="265.6,7.5 264.2,8.9 265.6,10.3 267,8.9     "/>
            <polygon class="fill-white" points="248.9,7.5 247.5,8.9 248.9,10.3 250.3,8.9     "/>
            <polygon class="fill-white" points="233.5,8.9 232.1,7.5 230.7,8.9 232.1,10.3     "/>
            <polygon class="fill-white" points="499.4,46.8 498,48.2 499.4,49.6 500.8,48.2     "/>
            <polygon class="fill-white" points="482.6,46.8 481.2,48.2 482.6,49.6 484,48.2     "/>
            <polygon class="fill-white" points="465.8,46.8 464.4,48.2 465.8,49.6 467.2,48.2     "/>
            <polygon class="fill-white" points="450.3,46.8 448.9,48.2 450.3,49.6 451.6,48.2     "/>
            <polygon class="fill-white" points="433.5,46.8 432.1,48.2 433.5,49.6 434.9,48.2     "/>
            <polygon class="fill-white" points="416.7,46.8 415.3,48.2 416.7,49.6 418.1,48.2     "/>
            <polygon class="fill-white" points="399.9,46.8 398.5,48.2 399.9,49.6 401.3,48.2     "/>
            <polygon class="fill-white" points="383.1,46.8 381.7,48.2 383.1,49.6 384.5,48.2     "/>
            <polygon class="fill-white" points="366.3,46.8 364.9,48.2 366.3,49.6 367.7,48.2     "/>
            <polygon class="fill-white" points="349.6,46.8 348.2,48.2 349.6,49.6 351,48.2     "/>
            <polygon class="fill-white" points="332.8,46.8 331.4,48.2 332.8,49.6 334.2,48.2     "/>
            <polygon class="fill-white" points="316,46.8 314.6,48.2 316,49.6 317.4,48.2     "/>
            <polygon class="fill-white" points="299.2,46.8 297.8,48.2 299.2,49.6 300.6,48.2     "/>
            <polygon class="fill-white" points="282.4,46.8 281,48.2 282.4,49.6 283.8,48.2     "/>
            <polygon class="fill-white" points="265.6,46.8 264.2,48.2 265.6,49.6 267,48.2     "/>
            <polygon class="fill-white" points="248.9,46.8 247.5,48.2 248.9,49.6 250.3,48.2     "/>
            <polygon class="fill-white" points="233.5,48.2 232.1,46.8 230.7,48.2 232.1,49.6     "/>
            <polygon class="fill-white" points="482.6,27.3 481.2,28.7 482.6,30.1 484,28.7     "/>
            <polygon class="fill-white" points="465.8,27.3 464.4,28.7 465.8,30.1 467.2,28.7     "/>
            <polygon class="fill-white" points="450.3,27.3 448.9,28.7 450.3,30.1 451.6,28.7     "/>
            <polygon class="fill-white" points="433.5,27.3 432.1,28.7 433.5,30.1 434.9,28.7     "/>
            <polygon class="fill-white" points="399.9,27.3 398.5,28.7 399.9,30.1 401.3,28.7     "/>
            <polygon class="fill-white" points="383.1,27.3 381.7,28.7 383.1,30.1 384.5,28.7     "/>
            <polygon class="fill-white" points="349.6,27.3 348.2,28.7 349.6,30.1 351,28.7     "/>
            <polygon class="fill-white" points="332.8,27.3 331.4,28.7 332.8,30.1 334.2,28.7     "/>
            <polygon class="fill-white" points="299.2,27.3 297.8,28.7 299.2,30.1 300.6,28.7     "/>
            <polygon class="fill-white" points="282.4,27.3 281,28.7 282.4,30.1 283.8,28.7     "/>
            <polygon class="fill-white" points="248.9,27.3 247.5,28.7 248.9,30.1 250.3,28.7     "/>
            <polygon class="fill-white" points="233.5,28.7 232.1,27.3 230.7,28.7 232.1,30.1     "/>
          </g>
        </svg>
      </div>

      <div class="col-md-6 col-lg-5 offset-lg-1">
        <h2 class="display-2 mb-3 text-primary"><?php echo __('Nossa essência é o capital humano', 'penumbra'); ?></h2>
        <h5 class="display-5 text-dk-grey mb-5"><?php echo __('Acreditamos que pessoas são o nosso principal ativo.', 'penumbra'); ?></h5>
      </div>



    </div>
    <div class="row justify-content-center scrollpop slide-up-children">
      <?php
      $args = array(
        'post_type' => 'equipe',
        'posts_per_page' => 4,
        'orderby' => 'date',
        'order' => 'asc'
      );

      // Custom query.
      $query = new WP_Query( $args );

      // Check that we have query results.
      if ( $query->have_posts() ) {
        ?>

      <?php
                    // Start looping over the query results.
                    while ( $query->have_posts() ) {

                      $query->the_post();

                      get_template_part( 'loop-templates/content-'.get_post_type());
                      // Contents of the queried post results go here.

                    }
                    ?>

        <?php
      }

      // Restore original post data.
      wp_reset_postdata();

      ?>

    </div>
    <div class="row mt-5">
      <div class="col text-center">
        <a href="/equipe" data-post-id="110" class="btn btn-secondary scrollpop" ><?php echo __('Conheça todo o time','penumbra') ?></a>
      </div>
    </div>
  </div>
</section>
