<?php
/**
* The template for displaying the footer.
*
* Contains the closing of the #content div and all content after
*
* @package understrap
*/

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$container = get_theme_mod( 'understrap_container_type' );
?>

</main>

<div class="modal fade modal--produto" id="modal" tabindex="-1" role="dialog" aria-labelledby="modal-title" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <button type="button" class="fechar" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      <div class="modal-body p-0">
        ...
      </div>
    </div>
  </div>
</div>

<footer>

	<div class="container-fluid bg-secondary text-background">

		<?php get_template_part( 'sidebar-templates/sidebar-footerfull') ?>

	</div><!-- container end -->
  <div class="container-fluid bg-background text-primary py-3">
    <div class="container">
      <p class="footer-credits mb-0">
        © <?php echo current_time('Y'); ?> A Central Alimentação — Website design + código <a class="text-secondary" href="https://penumbra.design?ref=<?php echo get_home_url(); ?>" target="_blank">Penumbra</a>
      </p>
    </div>
  </div>
</footer><!-- wrapper end -->

</div><!-- #page we need this extra closing tag here -->

<?php wp_footer(); ?>

</body>

</html>
