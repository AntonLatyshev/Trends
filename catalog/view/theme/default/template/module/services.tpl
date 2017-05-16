<div class="content-box services">
  <div class="services-box">
    <div class="box-title"><?php echo $text_our_service; ?></div>
    <div class="content-services">
      <ul>
        <?php foreach ($banners as $item) { ?>
          <li>
            <a href="<?php echo $item['link']; ?>" class="services-ovh">
              <div class="services-info">
                <?php if ($item['image_add']) { ?>
                  <div class="brand-img">
                    <img src="<?php echo $item['image_add']; ?>" width="<?php echo $item['width_add']; ?>" height="<?php echo $item['height_add']; ?>">
                  </div>
                <?php } else { ?>
                  <div class="brand-img"></div>
                <?php } ?>
                <span class="services-name"><?php echo $item['title']; ?></span>
                <span class="go-services"><?php echo $text_go; ?><em></em></span>
              </div>
              <div class="services-img">
                <img src="<?php echo $item['image']; ?>" alt="<?php echo $item['title']; ?>" width="<?php echo $item['width']; ?>" height="<?php echo $item['height']; ?>">
              </div>
            </a>
          </li>
        <?php }; ?>
      </ul>
    </div>
    <div class="all-services-box">
      <div class="all-services-holder">
        <a class="all-services" href="#"><?php echo $text_all_service; ?></a>
      </div>
    </div>
  </div>
</div>