<div class="content-box">
  <div class="box-title"><?php echo $text_our_partners; ?><span class="box-signature"><?php echo $text_partners_best; ?></span>
  </div>
</div>
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