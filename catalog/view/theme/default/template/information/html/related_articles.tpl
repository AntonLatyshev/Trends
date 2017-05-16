<div class="sidebar-news">
  <?php if ($article) { ?>
    <span class="blog-title"><?php echo $heading_title; ?></span>
    <ul class="blog-news">
      <?php foreach ($article as $articles) { ?>
        <li class="news">
          <div class="news-img">
            <a href="<?php echo $articles['href']; ?>">
              <img src="<?php echo $articles['thumb']; ?>" width="92" height="65" alt="<?php echo $articles['name']; ?>">
            </a>
          </div>
          <div class="news-info">
            <a href="<?php echo $articles['href']; ?>" class="news-title"><?php echo $articles['name']; ?></a>
            <div class="short-info">
              <p><?php echo $articles['description']; ?></p>
            </div>
          </div>
        </li>
      <?php } ?>
    </ul>
  <?php } ?>
</div>