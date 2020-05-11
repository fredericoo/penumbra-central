<div class="carousel" data-flickity='{ "arrowShape": "M44.5,89.1 0,44.5 44.5,0 46,1.4 2.8,44.5 46,87.7", "cellAlign": "center", "contain": false, "autoPlay" : 3000, "pauseAutoPlayOnHover": false, "pageDots": false }'>

<?php
  $images = get_sub_field('imagens');
  $size = 'huge'; // (thumbnail, medium, large, full or custom size)
?>
<?php foreach( $images as $image ): ?>
  <div class="col-10 col-lg-8 ">
    <?php smart_image( $image['ID'], $size,'nobg vh-80 contain pb-0','fade poponce'); ?>
  </div>
<?php endforeach; ?>

</div>
