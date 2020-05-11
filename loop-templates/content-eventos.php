<div class="col-xl-4 col-lg-4 col-6 grid__item mb-30px">
    <div class="scrollpop slide-up poponce evento <?php if (get_post_thumbnail_id()) echo 'evento--hasimage' ?>">
      <a href="<?php the_permalink() ?>" data-toggle="modal" data-target="#modal" data-modal-id="<?php echo get_the_ID(); ?>" ><?php smart_image(get_post_thumbnail_id(),'large','scrollpop reveal poponce','fade poponce') ?></a>
      <timestamp class="evento__date"><?php the_field('data') ?></timestamp>
      <div class="evento__body">
        <a href="<?php the_permalink() ?>" data-toggle="modal" data-target="#modal" data-modal-id="<?php echo get_the_ID(); ?>" ><h3 class="evento__body__title"><?php the_title() ?></h3></a>
        <div class="evento__body__excerpt"><?php the_content() ?></div>
      </div>
    </div>
</div>
