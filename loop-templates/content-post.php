<div class="grid__item mb-30px <?php echo (get_field('destaque') == 1 ? 'grid__item--large col-lg-6 col-12' : 'col-lg-3 col-6') ?>">
    <div class="article scrollpop slide-up poponce article--fade <?php if (get_post_thumbnail_id()) echo 'article--hasimage' ?>">
      <div class="article__image">
        <a data-post-id="<?php echo get_the_ID() ?>" href="<?php the_permalink() ?>" ><?php smart_image(get_post_thumbnail_id(),'large','scrollpop reveal ','fade poponce') ?></a>
      </div>
      <div class="article__body">
        <timestamp class="article__body__date"><?php echo get_the_date(); ?></timestamp>
        <a data-post-id="<?php echo get_the_ID() ?>" href="<?php the_permalink() ?>" ><h3 class="article__body__title"><?php the_title() ?></h3></a>
        <div class="article__body__excerpt"><?php echo get_the_excerpt() ?: get_first_paragraph() ?></div>
      </div>
    </div>
</div>
