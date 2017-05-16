<div class="bests-brands">
  <span class="box-title"><?php echo $text_brands; ?></span>
  <div class="content-box partners">
    <div class="content-catalog partners">
      <ul>
        <?php foreach ($banners as $item) { ?>
          <li class="catalog-item">
            <a href="<?php echo $item['link']; ?>">
              <div class="catalog-image">
                <img src="<?php echo $item['image']; ?>" width="<?php echo $item['width']; ?>" height="<?php echo $item['height']; ?>">
              </div>
            </a>
          </li>
        <?php }; ?>
      </ul>
    </div>
  </div>
</div>