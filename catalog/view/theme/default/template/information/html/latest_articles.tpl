<div class="content-box article">
    <div class="box-title"><?php echo $text_latest_art; ?> <span class="box-signature"><?php echo $text_be_informed; ?></span>
    </div>
    <div class="product-list">
        <ul class="tabset">
            <?php foreach ($blog_categories as $key => $category) { ?>
                <?php if (!empty($category['articles'])) { ?>
                    <li>
                        <a class="tab <?php echo $key==0 ? 'active' : ''; ?>" href="#tab-3<?php echo $key+1; ?>"><?php echo $category['name']; ?></a>
                    </li>
                <?php } ?>
            <?php } ?>
        </ul>
        <div class="tab-holder">
            <?php foreach ($blog_categories as $key => $category) { ?>
                <?php if (!empty($category['articles'])) { ?>
                    <div id="tab-3<?php echo $key+1; ?>">
                        <div class="article-slider-holder">
                            <ul class="news-slider">
                                <?php foreach ($category['articles'] as $article) { ?>
                                    <li class="slide-news-box">
                                        <div class="news-box-img">
                                            <a href="<?php echo $article['href']; ?>">
                                                <img src="<?php echo $article['image']; ?>" alt="<?php echo $article['title']; ?>" width="373" height="218">
                                            </a>
                                        </div>
                                        <div class="news-box-info">
                                            <span class="info-date"><?php echo $article['date_added']; ?></span>
                                            <a href="<?php echo $article['href']; ?>"><?php echo $article['title']; ?></a>
                                            <div class="info-text">
                                                <p><?php echo $article['description']; ?></p>
                                            </div>
                                        </div>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                <?php } ?>
            <?php } ?>
        </div>
    </div>
    <div class="all-services-box">
        <div class="all-services-holder">
            <a class="all-services" href="#"><?php echo $text_all_article; ?></a>
        </div>
    </div>
</div>