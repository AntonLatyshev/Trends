<span class="reviews-box-title">Написать отзыв</span>
<div class="user-rating">
    <div class="estimate">
        <div class="estimate__block">
            <input checked="" type="radio" class="estimate__radio" id="star_1" name="rating" value="1">
            <label class="estimate__label icon5" for="star_1" data-evaluation-text="Отлично" data-evaluation-color="#64d948"></label>
            <input type="radio" class="estimate__radio" id="star_2" name="rating" value="2">
            <label class="estimate__label icon4" for="star_2" data-evaluation-text="Хорошо" data-evaluation-color="#9ed534"></label>
            <input type="radio" class="estimate__radio" id="star_3" name="rating" value="3">
            <label class="estimate__label icon3" for="star_3" data-evaluation-text="Средне" data-evaluation-color="#ffb72b"></label>
            <input type="radio" class="estimate__radio" id="star_4" name="rating" value="4">
            <label class="estimate__label icon2" for="star_4" data-evaluation-text="Плохо" data-evaluation-color="#fa703a"></label>
            <input type="radio" class="estimate__radio" id="star_5" name="rating" value="5">
            <label class="estimate__label icon1" for="star_5" data-evaluation-text="Ужасно" data-evaluation-color="#ff0404"></label>
        </div>
    </div>
    <div class="evaluation-block">
        <div class="evaluation-icon smile5 active" data-smile="star_1"></div>
        <div class="evaluation-icon smile4" data-smile="star_2"></div>
        <div class="evaluation-icon smile3" data-smile="star_3"></div>
        <div class="evaluation-icon smile2" data-smile="star_4"></div>
        <div class="evaluation-icon smile1" data-smile="star_5"></div>
        <div class="evaluation-text">Отлично</div>
    </div>
</div>
<form class="form-faq" name="add-review" id="form-review">
    <input type="hidden" name="review-condition" value="5">
    <textarea rows="1" placeholder="Текст отзыва" name="text"></textarea>
    <input type="text" placeholder="Имя" name="name" value="<?php echo $name;?>">
    <input type="email" placeholder="Email" name="email" value="<?php echo $email;?>">
    <div class="button-box">
        <button type="submit" class="submit-form" id="button-review">Оставить отзыв</button>
    </div>
</form>


<script>
    $(document).on('click', '#star_1',function() {
        $('#form-review [name="review-condition"]').val(this.value);
    });
    $(document).on('click', '#star_2',function() {
        $('#form-review [name="review-condition"]').val(this.value);
    });
    $(document).on('click', '#star_3',function() {
        $('#form-review [name="review-condition"]').val(this.value);
    });
    $(document).on('click', '#star_4',function() {
        $('#form-review [name="review-condition"]').val(this.value);
    });
    $(document).on('click', '#star_5',function() {
        $('#form-review [name="review-condition"]').val(this.value);
    });
</script>