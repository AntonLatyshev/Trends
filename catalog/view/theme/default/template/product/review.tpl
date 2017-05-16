<?php if ($reviews) { ?>
  <?php foreach ($reviews as $review) { ?>
    <ul>
      <div class="reviews-user">
        <span class="user-name"><?php echo $review['author']; ?></span>
        <span class="date-reviews"><?php echo $review['date_added']; ?></span>
        <ul class="rating-reviews">
          <?php for ($i = 1; $i <= 5; $i++) { ?>
            <?php if ($review['rating'] < $i) { ?>
              <li></li>
            <?php } else { ?>
              <li class="active"></li>
            <?php } ?>
          <?php } ?>
        </ul>
      </div>
      <div class="reviews-user-text">
        <p><?php echo $review['text']; ?></p>
      </div>
      <div class="user-text-rating">
        <span class="answer"><a href="#">Ответить</a></span>
        <ul class="like-box">
          <li class="like">31</li>
          <li class="dislike">3</li>
        </ul>
      </div>
    </ul>
    <a href="#" class="more-reviews-users">Больше отзывов</a>
  <?php } ?>
  <div class="text-right"><?php echo $pagination; ?></div>
<?php } else { ?>
  <p><?php echo $text_no_reviews; ?></p>
<?php } ?>
