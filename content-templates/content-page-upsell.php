<div class="upsell p-2">
  <h1 class="upsell__titulo text-background"><?php the_title() ?></h1>
  <div class="upsell__texto text-background">
    <?php the_content(); ?>
  </div>
  <div class="upsell__produtos">
      <?php $posts = get_field('produtos');
      if( $posts ): ?>
      <div class="row">
      <?php foreach( $posts as $post): // variable must be called $post (IMPORTANT) ?>
        <div class="col-12">
          <?php setup_postdata($post);
          get_template_part( 'content-templates/content-product', get_post_field( 'post_name', get_post() )); ?>
        </div>
      <?php endforeach; ?>
      </div>
      <?php wp_reset_postdata(); endif; ?>
  </div>
  <div class="upsell_next mb-5">
    <a href="<?php echo wc_get_checkout_url() ?>" class="btn btn-primary btn-block btn-lg py-4 btn-rounded">Próxima etapa</a>
  </div>
</div>
