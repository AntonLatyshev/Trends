<div class="top-products">
    <span class="top-title"><?php echo $text_our_service; ?></span>
    <div class="top-products-slider">
        <?php foreach ($banners as $item) { ?>
            <div class="product-slide services-slide">
                <a href="<?php echo $item['link']; ?>">
                    <div class="product-img">
                        <img src="<?php echo $item['image']; ?>" alt="<?php echo $item['title']; ?>" width="<?php echo $item['width']; ?>" height="<?php echo $item['height']; ?>">
                    </div>
                    <div class="product-info">
                        <span class="product-name"><?php echo $item['title']; ?></span>
                        <p><?php echo $item['text']; ?></p>
                    </div>
                </a>
            </div>
        <?php } ?>
    </div>
</div>