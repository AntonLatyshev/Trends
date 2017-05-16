<?php if ($reviews) { ?>
<ul class="review-append">
    <?php foreach($reviews as $result) { ?>
        <li>
            <div class="reviews-user">
                <span class="user-name"><?php echo $result['author'];?></span>
                <span class="date-reviews"><?php echo $result['date_added'];?></span>
                <ul class="rating-reviews">
                    <?php for ($i = 1; $i <= 5; $i++) { ?>
                        <?php if ($result['rating'] < $i) { ?>
                            <li></li>
                        <?php } else { ?>
                            <li class="active"></li>
                        <?php } ?>
                    <?php } ?>
                </ul>
            </div>
            <div class="reviews-user-text">
                <p><?php echo $result['text'];?></p>
            </div>
            <div class="user-text-rating" data-review-id="<?php echo $result['review_id'];?>">
                <span class="answer">Ответить</span>
                <?php if (count($result['answers']) != 0) { ?>
                    <span class="quantity-answer"><?php echo count($result['answers']);?> ответа</span>
                <?php } ?>
                <div class="like-box">
                    <?php if($result['scores'] && $result['scores']['likes']) { ?>
                    <div class="like-review like active">
                    <?php } else { ?>
                    <div class="like-review like">
                    <?php }?>
                        <div class="review-icon like-icon"></div>
                        <div class="review-count"><?php echo $result['likes'];?></div>
                    </div>
                    <?php if($result['scores'] && $result['scores']['dislike']) { ?>
                    <div class="like-review dislike active">
                    <?php } else { ?>
                    <div class="like-review dislike">
                    <?php }?>
                        <div class="review-icon dislike-icon"></div>
                        <div class="review-count"><?php echo $result['dislike'];?></div>
                    </div>
                </div>
            </div>
            <?php if($result['answers']) { ?>
                <ul class="quantity-answer-popup">
                    <?php foreach($result['answers'] as $answers) { ?>
                        <li>
                            <div class="reviews-user">
                                <span class="user-name"><?php echo $answers['author'];?></span>
                                <span class="date-reviews"><?php echo $answers['date_added'];?></span>
                            </div>
                            <div class="reviews-user-text">
                                <p><?php echo $answers['text'];?></p>
                            </div>
                        </li>
                    <?php } ?>
                </ul>
            <?php } ?>
        </li>
    <?php } ?>
</ul>
<form class="form-faq fast-answer" name="add-review-answer" id="form-review-answer">
    <input type="hidden" name="review-id" value="">
    <textarea rows="1" placeholder="Текст отзыва" name="text"></textarea>
    <input type="text" placeholder="Имя" name="name" value="<?php echo $name;?>">
    <input type="email" placeholder="Email" name="email" value="<?php echo $email;?>">
    <div class="button-box">
        <button type="submit" class="submit-form" id="button-review-answer">Оставить отзыв</button>
        <span class="cancel-form">Отмена</span>
    </div>
</form>
<?php if(!empty($pagination)) { ?>
    <span class="more-reviews-users" id="more_review" data-total="<?php echo $totals;?>">Больше отзывов</span>
    <?php echo $pagination;?>
<?php } ?>
<?php } else { ?>
  <p><?php echo $text_empty; ?></p>
<?php } ?>

<div id="temp_block" style="display:none;"></div>
<style>
    .user-reviews-box .pagination{
        display:none;
    }
</style>
