<div class="why-we">
  <div class="why-we-holder">
    <span class="box-title"><?php echo $text_why_we; ?></span>
    <ul class="box-advantages">
      <?php foreach ($banners as $item) { ?>
        <li class="advantage">
          <div class="box-img">
            <div class="icon-holder <?php echo $item['additional']; ?>"></div>
          </div>
          <span class="advantage-text"><?php echo $item['title']; ?></span>
        </li>
      <?php } ?>
    </ul>
  </div>
</div>