<div class="popup-after-add-review">
	<div class="add-review-holder">
		<span class="close-popup-review after">ОК</span>
		<div class="after-submit-form">
			<span class="success-text">Ваша заявка отправлена.</span>
		</div>
	</div>
</div>

<div class="popup-service">
	<div class="popup-holder">
		<span class="close-popup"></span>
		<div class="popup-service-box">
			<span class="title-service"></span>
			<span class="btn-title"></span>
			<form class="form-faq" id="form-service" action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
				<input type="text" name="name" placeholder="Имя">
				<div class="name-danger"></div>
				
				<input type="tel" name="phone" placeholder="Телефон">
				<div class="phone-danger"></div>
				
				<textarea name="comment" placeholder="Коментарий" rows="1"></textarea>
				<div class="comment-danger"></div>
				
				<button class="submit-form after-add-review">Отправить</button>
				<input type="hidden" name="title" value="">
				<input type="hidden" name="subtitle" value="">
				<input type="hidden" name="page" value="">
			</form>
		</div>
	</div>
</div>