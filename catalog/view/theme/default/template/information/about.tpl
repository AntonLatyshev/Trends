<?php echo $header; ?>

  <div id="main">
    <div class="image-top" style="background-image: url('/image/<?php echo $custom_field['image_bg']; ?>');">
      <div class="image-holder">
        <ul class="breadcrumbs">
          <?php foreach ($breadcrumbs as $i=> $breadcrumb) { ?>
            <li><?php if($i+1<count($breadcrumbs)) { ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a> <?php } else { ?><span><?php echo $breadcrumb['text']; ?></span><?php } ?></li>
          <?php } ?>
        </ul>
        <span class="title-text"><?php echo $heading_title; ?></span>
      </div>
    </div>
    <div class="content-trends">
      <div class="content-trends-holder">
        <div class="content-trends-box">
          <div class="box-title">
            <span class="box-name" data-text="<?php echo $custom_field['trends_store']; ?>"><?php echo $custom_field['trends_store']; ?></span>
          </div>
          <div class="mCustomScrollbar" data-mcs-theme="dark">
            <div class="box-text">
              <?php echo $description; ?>
            </div>
          </div>
        </div>
        <div class="content-trends-img">
          <img src="/image/<?php echo $custom_field['image']; ?>" alt="photo" width="617" height="392">
        </div>
      </div>
    </div>

    <?php echo $content_bottom; ?>

  </div>

<?php echo $footer; ?>