<span class="mobile-opener"><?php echo $text_show_category; ?></span>
<ul class="nav-blog-box">
  <?php foreach ($blog_categories as $key => $category) { ?>
    <?php if (!empty($category['articles'])) { ?>
      <li class="blog-link">
        <a href="<?php echo $category['ncat_href']; ?>"><?php echo $category['name']; ?></a>
      </li>
    <?php } ?>
  <?php } ?>
</ul>