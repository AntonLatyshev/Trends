<div class="content-box <?php echo $content_box_class; ?>">
  <div class="box-title"><?php echo $block_title; ?></div>
  <div class="product-list">
    <ul class="tabset">
      <?php foreach ($tabs_title as $key => $tab_title) { ?>
          <li>
            <a class="tab <?php echo $key==0 ? 'active' : ''; ?>" href="#tab-<?php echo $tab_index; ?><?php echo $key+1; ?>"><?php echo $tab_title; ?></a>
          </li>
      <?php } ?>
    </ul>
    <div class="tab-holder">
      <?php foreach ($tabs_title as $key => $tab_title) { ?>
        <div id="tab-<?php echo $tab_index; ?><?php echo $key+1; ?>">
          <div class="content-catalog <?php echo $content_catalog_class; ?>">
            <?php if ($module_id == 64) { ?>
            <div class="catalog-sale-slider">

              <?php foreach ($products as $product) { ?>
                <?php if ($product['promotag']) { ?>
                  <?php if ($tab_title == $product['promotag']['tab_name']) { ?>
                    <div class="catalog-item">
                      <div class="image-holder">
                        <a href="<?php echo $product['href']; ?>">
                          <?php if ($product['promotag']) { ?>
                            <span class="catalog-<?php echo $product['promotag']['class']; ?>"><?php echo $product['promotag']['text']; ?></span>
                          <?php } ?>
                          <div class="catalog-image">
                            <img src="<?php echo $product['thumb']; ?>" width="229" height="216">
                          </div>
                          <?php if ($product['images']) { ?>
                            <div class="catalog-image-hover">
                              <img src="<?php echo $product['images'][0]; ?>" width="255" height="240">
                            </div>
                          <?php } ?>
                        </a>
                      </div>
                      <div class="description">
                        <a href="<?php echo $product['href']; ?>" class="catalog-name"><?php echo $product['name']; ?></a>
                        <div class="item-description">
                          <p><?php echo $product['description']; ?></p>
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
                <?php } ?>
              <?php } ?>

            </div>
            <?php } else { ?>

              <?php $i = 1; ?>
              <?php foreach ($products as $product) { ?>
                <?php if (in_array($tab_title, $product['categories'])) { ?>
                  <?php if ($i <= 8) { ?>
                    <div class="catalog-item">
                      <div class="image-holder">
                        <a href="<?php echo $product['href']; ?>">
                          <?php if ($product['promotag']) { ?>
                            <span class="catalog-<?php echo $product['promotag']['class']; ?>"><?php echo $product['promotag']['text']; ?></span>
                          <?php } ?>
                          <div class="catalog-image">
                            <img src="<?php echo $product['thumb']; ?>" width="229" height="216">
                          </div>
                          <?php if ($product['images']) { ?>
                            <div class="catalog-image-hover">
                              <img src="<?php echo $product['images'][0]; ?>" width="255" height="240">
                            </div>
                          <?php } ?>
                        </a>
                      </div>
                      <div class="description">
                        <a href="<?php echo $product['href']; ?>" class="catalog-name"><?php echo $product['name']; ?></a>
                        <div class="item-description">
                          <p><?php echo $product['description']; ?></p>
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
                    <?php $i++; ?>
                  <?php } ?>
                <?php } ?>
              <?php } ?>

            <?php } ?>
          </div>
        </div>
      <?php } ?>
    </div>
  </div>
</div>