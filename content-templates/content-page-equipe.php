<section id="section-equipe" class="section section--equipe">
  <div class="container">

<div class="row grid mt-5 grid--fitRows">
  <aside class="grid-sizer col-1"></aside>

  <div class="membro-equipe grid__item px-0 col-12 col-lg-6 mb-30px">
  	<div class="p-3 p-lg-5 bg-secondary text-white">
  		<h1 class="display-2"><?php the_title(); ?></h1>
      <?php the_content();   ?>
  	</div>
  </div>

      <?php
      $args = array(
        'post_type' => 'equipe',
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

      ?>
    </div>
  </div>
</section>
