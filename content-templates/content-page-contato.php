<section id="section-head" class="section pt-5 mt-5 section--head bg-pattern">
  <div class="container">
    <div class="row">
      <div class="col-md-9 offset-md-2 bg-secondary text-white scrollpop slide-up poponce">
        <div class="p-5">
          <div class="row">
            <div class="col-lg-8">
              <h1 class="mb-4 scrollpop slide-up ms-100 poponce"><?php the_title() ?></h1>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-8 order-lg-2">
              <div class="scrollpop slide-up ms-200 poponce"><?php the_content(); ?></div>
              <div class="row mt-5 scrollpop slide-up ms-300 poponce">
                <div class="col-6">
                  <a href="/contato/investir" class="btn btn-outline-lt-grey btn-lg btn-block h-100"><?php echo __('Quer investir','penumbra') ?></a>
                </div>
                <div class="col-6">
                  <a href="/contato/receber" class="btn btn-outline-lt-grey btn-lg btn-block h-100"><?php echo __('Quer receber investimento','penumbra') ?></a>
                </div>
              </div>
            </div>
            <div class="col-lg-7 ml-nremainder order-lg-1 mb-n5">
              <?php smart_image(get_post_thumbnail_id(),'large','scrollpop slide-up poponce ms-100','fade poponce') ?>
            </div>
          </div>
        </div>
      </div>
    </div>

      <?php if( have_rows('escritorios') ): ?>
        <div class="row mt-5">
          <div class="offset-md-4 col-md-4">
            <h2 class="mb-5 scrollpop slide-up poponce"><?php echo __('Nossos escritórios','penumbra') ?></h2>
          </div>
        </div>
        <div class="row justify-content-end">
        <?php  while ( have_rows('escritorios') ) : the_row(); ?>

          <div class="col-lg-4 col-md-6 scrollpop slide-up poponce">
            <h4><?php the_sub_field('nome') ?></h4>
            <address class="">
              <?php the_sub_field('endereco') ?>
            </address>
          </div>

        <?php endwhile; ?>
      </div>
      <?php endif; ?>

  </div>
</section>

<?php get_template_part( 'sidebar-templates/sidebar-boletim-semanal'); ?>
