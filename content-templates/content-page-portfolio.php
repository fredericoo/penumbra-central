<section id="section-head" class="section pt-5 mt-5 section--head">
  <div class="container">
    <div class="row">
      <div class="col-md-9 offset-md-2 bg-primary text-white scrollpop slide-up poponce">
        <div class="p-5">
          <div class="row">
            <div class="col-lg-8">
              <h1 class="mb-4 scrollpop slide-up ms-100 poponce"><?php the_title() ?></h1>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-8 order-lg-2">
              <div class="scrollpop slide-up ms-200 poponce"><?php the_content(); ?></div>
            </div>
            <div class="col-lg-7 ml-nremainder order-lg-1 mb-n5">
              <?php smart_image(get_post_thumbnail_id(),'large','scrollpop slide-up poponce ms-100','fade poponce') ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section id="section-partnerships" class="pt-0 section section--partnerships">
  <div class="container">
    <div class="row mb-5 py-2 bg-lt-grey">
      <div class="col-12">
        <label>Filtrar</label>
      </div>
    <div class="col-lg-12">
      <div class="row filtro--tipo justify-content-center">
                <a href="#" data-filter="" class="filter disabled btn mb-1 col-xl-1 col-lg-2 col-md-2 col-4"><?php smart_image(get_field('tudo_icone'),'large','nobg','fade') ?><figcaption><?php the_field('tudo_texto') ?></figcaption></a>
        <?php
        $categories = get_terms( 'tipo', array(
          'orderby'    => 'parent',
        ) );
        foreach ($categories as $cat) {
          ?>
          <a href="#" data-filter=".tipo-<?php echo $cat->term_id ?>" class="filter btn mb-1 col-xl-1 col-lg-2 col-md-2 col-4"><?php smart_image(get_field('icone', 'tipo_'.$cat->term_id),'large','nobg','fade') ?><figcaption><?php echo $cat->name ?></figcaption></a>
          <?php
        } ?>
      </div>
    </div>

    <div class="col-lg-3 col-md-4 col-12 mb-3 d-none">
      <select class="custom-select filtro filtro--fundo" >
        <option value="*"><?php echo __('Fundo','shibui'); ?></option>
        <?php
        $categories = get_terms( 'fundo', array(
          'orderby'    => 'parent',
        ) );
        foreach ($categories as $cat) {
          ?>
          <option value=".fundo-<?php echo $cat->term_id ?>"><?php echo $cat->name ?></option>
          <?php
        } ?>
    </select>
  </div>

</div>

<div class="row grid my-5 grid--fitRows">
  <div class="grid-sizer col-1"></div>
      <?php
      $args = array(
        'post_type' => 'portfolio',
        'posts_per_page' => -1,
        'orderby'=> 'title',
        'order' => 'ASC'
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
  </div>
</section>
