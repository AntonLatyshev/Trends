<div class="top-products">
  <span class="top-title"><?php echo $text_top_product; ?></span>
  <div class="top-products-slider">
    <?php foreach ($banners as $item) { ?>
      <div class="product-slide">
        <a href="<?php echo $item['link']; ?>">
          <span class="top-icon">TOP</span>
          <div class="product-img">
            <img src="<?php echo $item['image']; ?>" alt="<?php echo $item['title']; ?>" width="<?php echo $item['width']; ?>" height="<?php echo $item['height']; ?>">
          </div>
          <span class="product-name">
            <?php echo $item['title']; ?>
          </span>
          <span class="topical-price"><?php echo $item['additional']; ?></span>
        </a>
      </div>
    <?php } ?>
  </div>
</div>