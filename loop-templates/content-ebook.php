<div class="grid__item col-lg-6 col-sm-6 col-12 mb-30px">
  <div class="article article--ebook bg-primary">
    <a class="portfolio__image mb-3 d-block" href="<?php the_permalink() ?>" data-toggle="modal" data-target="#modal" data-modal-id="<?php echo get_the_ID(); ?>" >
    <?php smart_image(get_post_thumbnail_id(),'huge','o-60 scrollpop reveal poponce background-image h-100 pb-0','fade poponce') ?>
    <div class="article__body p-relative text-white">
      <timestamp class="article__body__date">e-book</timestamp>
      <h3 class="article__body__title"><?php the_title() ?></h3>
      <div class="article__body__excerpt"><?php the_excerpt() ?></div>
    </div>
  </a>
  </div>
</div>
