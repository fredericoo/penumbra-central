<section id="section-artigos" class="pt-5 mt-5 section section--artigos">
  <div class="container">
    <div class="grid row section--artigos__grid section--artigos__grid--highlightfirst grid--packery">
      <aside class="grid-sizer col-lg-3 col-6"></aside>
      <?php
      $args = array(
        'post_type' => 'post',
        'posts_per_page' => -1,
        'post_status' => 'publish'
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

      ?></div>
  </div>
</section>

<?php get_template_part( 'sidebar-templates/sidebar-boletim-semanal'); ?>
