<div class="catalog-slider">
  <?php foreach ($banners as $item) { ?>
    <div class="slide">
      <div class="slide-img">
        <img src="<?php echo $item['image']; ?>" alt="<?php echo $item['title']; ?>" width="1900" height="660">
        <div class="slide-info">
          <strong class="info-name"><?php echo $item['title']; ?></strong>
          <div class="info-text">
            <p><?php echo $item['text']; ?></p>
          </div>
          <span class="info-price"><?php echo $item['additional']; ?></span>
          <a class="info-buy-product" href="<?php echo $item['link']; ?>"><em></em><?php echo $text_buy; ?></a>
        </div>
      </div>
    </div>
  <?php }; ?>
</div>