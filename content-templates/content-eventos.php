<section class="my-5 py-5"><div class="container px-0">
    <div class="row">
      <div class="col-md-4">
        <?php smart_image(get_post_thumbnail_id(),'large','','fade pop') ?>
      </div>
      <div class="col-md-8">
        <div class="p-3"><?php //smart_image(get_field('logo'),'large','nobg','fade pop') ?>
          <h1><?php the_title() ?></h1>
          <?php the_content() ?>
          <div class="text-dk-grey"><?php the_excerpt() ?></div>

          <table class="table table-borderless table-striped">
            <tbody>

                <?php if (get_field('data')): ?>
                  <tr>
                    <th scope="row"><?php echo __('Quando','penumbra') ?></th>
                    <td><?php the_field('data') ?></td>
                  </tr>
                <?php endif; ?>
                <?php if (get_field('local')): ?>
                  <tr>
                    <th scope="row"><?php echo __('Onde','penumbra') ?></th>
                    <td><?php the_field('local') ?></td>
                  </tr>
                <?php endif; ?>
                <?php if (get_field('endereco')): ?>
                  <tr>
                    <th scope="row"><?php echo __('Endereço','penumbra') ?></th>
                    <td><?php the_field('endereco') ?></td>
                  </tr>
                <?php endif; ?>
                <?php if (get_field('link')): ?>
                  <tr>
                    <td colspan="2"><a href="<?php the_field('link') ?>" class="btn btn-tertiary"><?php echo __('Visite a página','penumbra') ?></a></td>
                  </tr>
                <?php endif; ?>

            </tbody>
          </table>

          </div>
      </div>
    </div>
  </div>
  </section>
