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
        
        <div class="produto produto--marmita">
          <div class="produto-grid">

            <div class="produto-grid__imagem">
              <div class="lazy-container produto__imagem nobg pb-50pc" style="--image-w:50; --image-h:50; --image-bg:#a16d42">
                <img class="lazyload swap" src="" data-was-processed="true">
              </div>
            </div>
            <h3 class="produto-grid__titulo produto__titulo"></h3>
            <div class="produto-grid__desc produto__desc"></div>
            <div class="produto__preco produto-grid__preco"></div>
          
          </div>

        </div>

      </div>
    </div>
  </div>
</div>

<footer>

	<div class="container-fluid bg-secondary text-background py-3">

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

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PGV5X62"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

</body>

</html>
