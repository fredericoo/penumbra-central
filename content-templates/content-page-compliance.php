<section id="section-head" class="section pt-5 mt-5 pb-0 section--head bg-pattern">
  <div class="container">
    <div class="row">
      <div class="col-12 bg-lt-grey scrollpop slide-up poponce">
          <div class="row">
            <div class="col-lg-6 px-0 vh-50 order-lg-2">
              <?php smart_image(get_post_thumbnail_id(),'huge','scrollpop slide-up poponce ms-100 pb-0 h-100','fade poponce ms-300') ?>
            </div>

            <div class="col-lg-6">
              <div class="p-3 p-md-5">
                <h1 class="mb-5 scrollpop slide-up ms-100 poponce"><?php the_title() ?></h1>
                <div class="lead scrollpop slide-up ms-200 poponce"><?php the_content(); ?></div>
              </div>
            </div>

          </div>
      </div>
    </div>
    <div class="row my-5">

      <div class="col-lg-6">
        <div class="p-3 p-md-5">
          <h2><?php the_field('titulo_manuais') ?></h2>
          <div class="body-text">
            <?php the_field('texto_manuais') ?>
          </div>
        </div>
      </div>

      <div class="col-lg-6 align-self-end">
        <?php smart_image(get_field('imagem_manuais'),'huge','scrollpop slide-up poponce ms-100','fade poponce ms-300') ?>
      </div>

    </div>

    <div class="row mb-5">
      <?php

      // check if the repeater field has rows of data
      if( have_rows('manuais') ):

      // loop through the rows of data
        while ( have_rows('manuais') ) : the_row(); ?>

          <div class="col-lg-3 grid__item mb-30px">
            <div class="article article--ebook bg-dark">
              <a href="<?php the_sub_field('link'); ?>" target="_blank">
              <?php smart_image(get_sub_field('imagem'),'huge','o-30 scrollpop reveal poponce background-image h-100 pb-0','fade poponce') ?>
              </a>
              <a href="<?php the_sub_field('link'); ?>" target="_blank">
                <div class="article__body p-relative text-white">
                  <timestamp class="article__body__date">manual</timestamp>
                  <h3 class="article__body__title"><?php the_sub_field('nome'); ?></h3>
                  <div class="article__body__excerpt"><?php the_sub_field('subtitulo'); ?></div>
                </div>
              </a>
            </div>
          </div>


        <?php endwhile;

      endif;

      ?>
    </div>

  </div>
</section>

<?php get_template_part( 'sidebar-templates/sidebar-faca-parte'); ?>
