<div class="our-team">
  <span class="box-title"><?php echo $text_our_team; ?></span>
  <ul class="our-team-slider">
    <?php foreach ($banners as $item) { ?>
      <li class="team-slide">
        <div class="slide-img">
          <img src="<?php echo $item['image']; ?>" alt="<?php echo $item['title']; ?>" width="<?php echo $item['width']; ?>" height="<?php echo $item['height']; ?>">
        </div>
        <div class="slide-info">
          <span class="person-name"><?php echo $item['title']; ?></span>
          <span class="person-position"><?php echo $item['additional']; ?></span>
          <div class="person-info">
            <p><?php echo $item['text']; ?></p>
          </div>
        </div>
      </li>
    <?php } ?>
  </ul>
</div>