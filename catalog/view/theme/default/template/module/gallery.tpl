<div class="gallery">
  <span class="box-title"><?php echo $text_gallery; ?></span>
  <ul class="gallery-slider">
    <?php foreach ($banners as $item) { ?>
      <li class="img-slide">
        <img src="<?php echo $item['image']; ?>" width="568" height="360">
      </li>
    <?php } ?>
  </ul>
</div>