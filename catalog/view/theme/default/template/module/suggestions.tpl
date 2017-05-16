<div class="special-sliders">
  <?php foreach ($banners as $item) { ?>
    <div class="slide-box">
      <img src="<?php echo $item['image']; ?>" alt="<?php echo $item['title']; ?>" width="<?php echo $item['width']; ?>" height="<?php echo $item['height']; ?>">
      <span class="slide-name"><?php echo $item['title']; ?></span>
    </div>
  <?php } ?>
</div>