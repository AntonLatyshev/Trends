<span class="box-title"><?php echo $heading_title; ?></span>
<div class="content-catalog slider-holder">
  <div class="catalog-sale-slider">
    <?php foreach ($products as $product) { ?>
      <div class="catalog-item">
        <div class="image-holder">
          <a href="<?php echo $product['href']; ?>">
            <?php if ($product['promotag']) { ?>
              <span class="catalog-<?php echo $product['promotag']['class']; ?>"><?php echo $product['promotag']['text']; ?></span>
            <?php } ?>
            <div class="catalog-image">
              <img src="<?php echo $product['thumb']; ?>" width="244" height="229">
            </div>
            <?php if ($product['images']) { ?>
              <div class="catalog-image-hover">
                <img src="<?php echo $product['images'][0]; ?>" width="175" height="282">
              </div>
            <?php } ?>
          </a>
        </div>
        <div class="description">
          <a href="<?php echo $product['href']; ?>" class="catalog-name"><?php echo $product['name']; ?></a>
          <div class="item-description">
            <p><?php echo $product['short_description']; ?></p>
          </div>
          <div class="catalog-price">
            <?php if ($product['special']) { ?>
              <span class="old-price"><?php echo $product['price']; ?></span>
              <span class="sale-price"><?php echo $product['special']; ?></span>
            <?php } else { ?>
              <span class="topical-price"><?php echo $product['price']; ?></span>
            <?php } ?>
          </div>
          <div class="button-box">
            <div class="quantity">
              <input type="number" value="1" min="1" max="20" step="1">
            </div>
            <button type="button" class="item-buy" data-product-id="<?php echo $product['product_id']; ?>" <?php if ( $product['quantity'] >= '1' ) { ?>onclick="cart.add('<?php echo $product['product_id']; ?>');"<?php } ?>><em></em><?php echo $text_buy; ?></button>
            <span class="item-buy-click"><?php echo $text_buy_click; ?></span>
          </div>
        </div>
      </div>
    <?php } ?>
  </div>
</div>
