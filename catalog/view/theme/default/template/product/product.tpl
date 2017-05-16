<?php echo $header; ?>

<main id="main">
	<div class="image-top image-catalog" style="background-image: url('<?php echo $thumb_bg; ?>');">
		<div class="image-holder">
			<ul class="breadcrumbs">
				<?php foreach ($breadcrumbs as $i=> $breadcrumb) { ?>
					<li><?php if($i+1<count($breadcrumbs)) { ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a> <?php } else { ?><span><?php echo $breadcrumb['text']; ?></span><?php } ?></li>
				<?php } ?>
			</ul>
			<span class="title-text"><?php echo $heading_title; ?></span>
		</div>
	</div>
	<div class="product-card-box">
		<div class="product-card-slider">
			<?php if ($promotag) { ?>
				<div class="box-counter <?php echo (empty($promo_date_sale) ? 'center' : ''); ?>">
					<span class="product-<?php echo $promotag['class']; ?>"><?php echo $promotag['text']; ?></span>
					<?php if (!empty($promo_date_sale)) { ?>
						<div id="getting-started" data-countdown="<?php echo $promo_date_sale; ?>"></div>
					<?php } ?>
				</div>
			<?php } ?>
			
			<?php if ($images) { ?>
				<div class="big-slider">
					<?php foreach ($images as $image) { ?>
						<div class="slider-img">
							<a href="<?php echo $image['popup']; ?>">
								<img src="<?php echo $image['thumb']; ?>" title="notebook" alt="notebook" style="width: 372px; height: 355px;">
							</a>
						</div>
					<?php } ?>
				</div>
				<div class="mini-slider">
					<?php foreach ($images as $image) { ?>
						<div class="slider-mini-img">
							<img src="<?php echo $image['thumb_mini']; ?>" width="83" height="58">
						</div>
					<?php } ?>
				</div>
			<?php } ?>
		</div>

		<div class="product-card-info">
			<span class="product-card-title"><?php echo $heading_title; ?></span>
			<div class="product-rating-box">
				<span class="in-stock"><?php echo $stock; ?></span>
				<ul class="rating-reviews">
					<?php for ($i = 1; $i <= 5; $i++) { ?>
						<?php if ($rating < $i) { ?>
							<li></li>
						<?php } else { ?>
							<li class="active"></li>
						<?php } ?>
					<?php } ?>
				</ul>
			</div>
			<?php foreach ($options as $option) { ?>
				<?php if ($option['option_id'] == 16) { ?>
					<div class="color-box" id="input-option<?php echo $option['product_option_id']; ?>">
						<span class="color-box-title">ЦВЕТ</span>
						<?php foreach ($option['product_option_value'] as $option_value) { ?>
							<a href="#" class="<?php echo $option_value['name']; ?>"></a>
						<?php } ?>
						<!--<input checked type="radio" name="color" id="grey"/><label for="grey" class="grey"></label>
                              <input type="radio" name="color" id="black"/><label for="black" class="black"></label>
                              <input type="radio" name="color" id="purple"/><label for="purple" class="purple"></label></label>-->
					</div>
				<?php } ?>
			<?php } ?>
			<div class="price-box">
				<?php if ($special) { ?>
					<span class="total-price"><?php echo $special; ?></span>
					<span class="old-price"><?php echo $price; ?></span>
				<?php } else { ?>
					<span class="total-price"><?php echo $price; ?></span>
				<?php } ?>
			</div>
			<div class="product-buy-box" data-pid="<?php echo $product_id; ?>">
				<div class="quantity-counter">
					<div class="quantity">
						<input type="number" name="quantity" value="<?php echo $minimum; ?>" min="<?php echo $minimum; ?>" max="200" step="1">
					</div>
				</div>
				<span class="buy-product item-buy" onclick="cart.add('<?php echo $product_id; ?>', '<?php echo $minimum; ?>');"><?php echo $text_buy; ?></span>
				<span class="item-buy-click"><?php echo $text_buy_click; ?></span>
			</div>
			<div class="product-text-box">
				<span class="product-text-title"><?php echo $tab_description; ?></span>
				<div class="product-text">
					<p><?php echo $description_short; ?></p>
				</div>
			</div>
			<div class="social-box">
				<span class="share">Поделиться</span>
				<div class="share42init"></div>
			</div>
		</div>
	</div>
	<div class="product-list product-card">
		<ul class="tabset product-card">
			<?php if ($description) { ?>
				<li><a class="tab active" href="#tab-11"><?php echo $tab_description; ?></a></li>
			<?php } ?>
			<?php if ($attribute_groups) { ?>
				<li><a class="tab" href="#tab-12"><?php echo $tab_attribute; ?></a></li>
			<?php } ?>
			<?php if ($video) { ?>
			<li><a class="tab" href="#tab-13">ВИДЕО</a></li>
			<?php } ?>
			<?php if ($review_status) { ?>
				<li><a class="tab" href="#tab-14">ОТЗЫВЫ</a></li>
			<?php } ?>
			<li>
				<a class="tab" href="#tab-15">ДОСТАВКА И ОПЛАТА</a>
			</li>
		</ul>
		<div class="tab-holder product-card">
			<?php if ($description) { ?>
				<div id="tab-11">
					<div class="description-box">
						<?php echo $description; ?>
					</div>
				</div>
			<?php } ?>
			<?php if ($attribute_groups) { ?>
				<div class="tab-pane" id="tab-12">
					<table class="product-characteristics" cellspacing="0" cellpadding="0">
						<?php foreach ($attribute_groups as $attribute_group) { ?>
							<tr class="cap-table">
								<th><?php echo $attribute_group['name']; ?></th>
								<th></th>
							</tr>
							<?php foreach ($attribute_group['attribute'] as $attribute) { ?>
								<tr>
									<td><?php echo $attribute['name']; ?></td>
									<td><?php echo $attribute['text']; ?></td>
								</tr>
							<?php } ?>
						<?php } ?>
					</table>
				</div>
			<?php } ?>
			<?php if ($video) { ?>
				<div id="tab-13">
					<div class="video-holder">
						<iframe width="100%" height="100%" src="<?php echo $video; ?>" frameborder="0" allowfullscreen=""></iframe>
					</div>
				</div>
			<?php } ?>
			<?php if ($review_status) { ?>
			<div id="tab-14">
				<div class="product-reviews-holder">
					<div class="add-reviews-box">
						<?php echo $reviews_outside;?>
					</div>
					<div class="user-reviews-box">
						<?php echo $tabs_reviews;?>
					</div>
				</div>
			</div>
			<?php } ?>
			<div id="tab-15">
				<div class="delivery-pay-box">
					<?php echo $column_right; ?>
				</div>
			</div>
		</div>
	</div>

	<?php // блок Советуем посмотреть ?>
	<?php if ($products) { ?>
	<div class="content-box profitable advise">
		<span class="box-title"><?php echo $text_related; ?></span>
		<div class="content-catalog slider-holder">
			<div class="catalog-sale-slider">
				<?php foreach ($products as $product) { ?>
					<div class="catalog-item">
						<div class="image-holder">
							<a href="<?php echo $product['href']; ?>">
								<?php if ($product['promotag']) { ?>
									<span class="catalog-<?php echo $product['promotag']['class']; ?>"><?php echo $product['promotag']['text']; ?></span>
								<?php } ?>
								<div class="catalog-image">
									<img src="<?php echo $product['thumb']; ?>" width="244" height="229">
								</div>
								<?php if ($product['images']) { ?>
									<div class="catalog-image-hover">
										<img src="<?php echo $product['images'][0]; ?>" width="175" height="282">
									</div>
								<?php } ?>
							</a>
						</div>
						<div class="description">
							<a href="<?php echo $product['href']; ?>" class="catalog-name"><?php echo $product['name']; ?></a>
							<div class="item-description">
								<p><?php echo $product['short_description']; ?></p>
							</div>
							<div class="catalog-price">
								<?php if ($product['special']) { ?>
									<span class="old-price"><?php echo $product['price']; ?></span>
									<span class="sale-price"><?php echo $product['special']; ?></span>
								<?php } else { ?>
									<span class="topical-price"><?php echo $product['price']; ?></span>
								<?php } ?>
							</div>
							<div class="button-box">
								<div class="quantity">
									<input type="number" value="1" min="1" max="20" step="1">
								</div>
								<button type="button" class="item-buy" data-product-id="<?php echo $product['product_id']; ?>" <?php if ( $product['quantity'] >= '1' ) { ?>onclick="cart.add('<?php echo $product['product_id']; ?>');"<?php } ?>><em></em><?php echo $text_buy; ?></button>
								<span class="item-buy-click"><?php echo $text_buy_click; ?></span>
							</div>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
	<?php } ?>
	<?php // блок Ранее просмотренные ?>
	<div class="content-box profitable advise">
		<?php echo $content_bottom; ?>
	</div>

</main>

<div class="popup-order-click">
	<div class="order-click-holder">
		<span class="close-feedback"></span>
		<div class="hidden-feedback-box">
			<span class="feedback-name"><?php echo $text_fast_order;?></span>
			<span class="subname"><?php echo $text_fast_order_description;?></span>
			<form class="feedback-form form-faq" action="#" id="fast-order">
				<div class="row">
					<input type="text" placeholder="<?php echo $entry_name;?>" id="input-name" name="name" value="<?php echo $customer_name;?>">
					<input type="tel" placeholder="<?php echo $entry_telephone;?>" id="input-tel" name="telephone" value="<?php echo $customer_phone;?>">
				</div>
				<button type="submit" value="submit" class="feedback-submit"><?php echo $text_send;?></button>
			</form>
		</div>
	</div>
</div>
<script>
	var product_id = <?php echo $product_id; ?>;
	$('#fast-order').submit(function(e) {
		e.preventDefault();
		var data = {
			'product_id' : product_id,
			'phone_fast' : $('#fast-order input[name=telephone]').val(),
			'name'       : $('#fast-order input[name=name]').val(),
		}
		$.ajax({
			url: 'index.php?route=product/product/fastBuyPhone',
			type: 'POST',
			data: data,
			dataType: 'json',
			success: function (json) {
				$('#fast-order .error').remove();
				if (json['error']) {
					for(var key in json.error){
						if(json.error.hasOwnProperty(key)){
							$('#fast-order input[name="'+key+'"]').after('<label class="error">'+json.error[key]+'</label>');
						}
					}
				}

				if (json['success']) {
					$('#fast-order').append('<div class="success">'+json['success']+'</div>');
					$('#fast-order input[type=text], #fast-order input[type=tel]').val('');
					setTimeout(function(){
						$('#fast-order div.success').slideUp();
					},3000);
				}
			}
		});
	});
</script>

	<script>
		$( document ).ready(function() {
			$( ".img_class" ).click(function() {
				var pathValid = $(this).attr('data-img');
				console.log(pathValid);
				if(pathValid === "") {
					console.log('no photo');
				}else{
					var pathToImg = $(this).attr('data-img');
					var pathToPopup = $(this).attr('data-popup');
					$('.img_main').attr("src", pathToImg);
					<?php if (!$isXhr) { ?>$('.img_main').attr("data-zoom-image", pathToPopup);<?php } ?>
					$('.img_main').parent().attr("href", pathToPopup);
				}
			});
		});
	</script>

	<script type="text/javascript">
		$('#review').delegate('.pagination a', 'click', function(e) {
			e.preventDefault();

			var _href = this.href;

			function complete() {
				$('#review').load(_href);

				$('#review').fadeIn('slow');
			}

			$('#review').fadeOut('fast', complete);
		});

		$('#review').load('index.php?route=product/product/review&product_id=<?php echo $product_id; ?>');

		var href = $(".user-reviews-box .pagination li.active").next().find('a').attr('href');
		var next = parseInt($(".user-reviews-box .pagination li.active").next().text());
		var total_page = $("#more_review").attr('data-total');
		var product_id = <?php echo $product_id?>;
		var customer_id = <?php echo $customer_id;?>;

		if(next){
			$(".user-reviews-box #more_review").attr("data-href",href);

			$(document).on('click', '#more_review', function(e) {
				e.preventDefault();
				if(next-1!=total_page){
					var _href = $(this).attr('data-href');
					var htmls = "";

					htmls = $('#temp_block').load(_href + ' .review-append > ');

					setTimeout(function(){
						$('.user-reviews-box .review-append').append(htmls.html());
						$('#temp_block').html('');
						if(next == total_page) {
							$(".user-reviews-box #more_review").remove();
						} else {
							next = parseInt(next)+1;
							href = '/index.php?route=product/reviews_outside/infoReview&product_id=<?php echo $product_id?>&page='+next;
							$(".user-reviews-box #more_review").attr("data-href",href);
						}
					},100);
				}

			});

		}

		$(document).on('click', '#button-review',function(e) {
			e.preventDefault();
			$.ajax({
				url: 'index.php?route=product/product/write&product_id=<?php echo $product_id; ?>',
				type: 'post',
				dataType: 'json',
				data: $("#form-review").serialize(),
				success: function(json) {
					$('#form-review label.error').remove();

					if (json['error']) {
						for(var key in json.error){
							if(json.error.hasOwnProperty(key)){
								$('#form-review [name="'+key+'"]').after('<label class="error">'+json.error[key]+'</label>');
							}
						}
					}

					if (json['success']) {
						$('#form-review').append('<label class="succsess">'+json['success']+'</label>');
						$('#form-review input').val('');
						$('#form-review textarea').val('');
						setTimeout(function(){
							$('#form-review label.succsess').slideUp();
						},3000);
					}
				}
			});
		});

		$('.answer').click(function () {
			var review_id = $(this).parent().attr('data-review-id');
			$('#form-review-answer input[name="review-id"]').val(review_id);
		});

		$(document).on('click', '.answer', function () {
			var review_id = $(this).parent().attr('data-review-id');
			$('#form-review-answer input[name="review-id"]').val(review_id);
		});

		$('#form-review-answer').submit(function(e) {
			e.preventDefault();
			$.ajax({
				url: 'index.php?route=product/product/writeAnswer',
				type: 'post',
				dataType: 'json',
				data: $("#form-review-answer").serialize(),
				success: function(json) {
					$('#form-review-answer label.error').remove();

					if (json['error']) {
						for(var key in json.error){
							if(json.error.hasOwnProperty(key)){
								$('#form-review-answer [name="'+key+'"]').after('<label class="error">'+json.error[key]+'</label>');
							}
						}
					}

					if (json['success']) {
						$('#form-review-answer').append('<label class="succsess">'+json['success']+'</label>');
						$('#form-review-answer input').val('');
						$('#form-review-answer textarea').val('');
						setTimeout(function(){
							$('#form-review-answer label.succsess').slideUp();
						},3000);
					}
				}
			});
		});

		$(document).on('click','.like',function() {
			if(customer_id != 0) {
				if(!$(this).hasClass('active')){
					var likes = $(this).find('.review-count');
					var likes_count = likes.text();
					likes_count++;
					likes.text(likes_count);
					$(this).addClass('active');
					var data = {
						'metka': 'likes',
						'customer_id': customer_id,
						'product_id': product_id,
						'review_id': $(this).parent().parent().attr('data-review-id')
					}
					$.ajax({
						url: '/index.php?route=product/reviews_outside/likesDislikeReview',
						type: 'post',
						dataType: 'json',
						data: data,
						success: function(json) {
							console.log(json);
						},
						error: function() {
							console.error('Internal server error. Please contact system administrator.');
						}
					});
				}
				if($(this).next().hasClass('active')){
					var dislikes = $(this).next();
					var dislikes_count = dislikes.find('.review-count').text();
					dislikes_count--;
					dislikes.find('.review-count').text(dislikes_count);
					dislikes.removeClass('active');
				}

			} else {
				$('.user-block .btn-login').trigger('click');
			}
		});
		
		$(document).on('click','.dislike',function() {
			if(customer_id != 0) {
				if(!$(this).hasClass('active')){
					var likes = $(this).find('.review-count');
					var likes_count = likes.text();
					likes_count++;
					likes.text(likes_count);
					$(this).addClass('active');
					var data = {
						'metka': 'dislike',
						'customer_id': customer_id,
						'product_id': product_id,
						'review_id': $(this).parent().parent().attr('data-review-id')
					}
					$.ajax({
						url: '/index.php?route=product/reviews_outside/likesDislikeReview',
						type: 'post',
						dataType: 'json',
						data: data,
						success: function(json) {
						},
						error: function() {
							console.error('Internal server error. Please contact system administrator.');
						}
					});
				}
				if($(this).prev().hasClass('active')){
					var dislikes = $(this).prev();
					var dislikes_count = dislikes.find('.review-count').text();
					dislikes_count--;
					dislikes.find('.review-count').text(dislikes_count);
					dislikes.removeClass('active');
				}
			} else {
				$('.user-block .btn-login').trigger('click');
			}
		});

	</script>

	<script type="text/javascript">
		$(document).on('click', 'a.gallery-element', function (event) {
			event = event || window.event;
			var target = event.target || event.srcElement,
				link = target.src ? target.parentNode : target,
				options = {index: link, event: event},
				links = document.querySelectorAll('a.gallery-element');
			blueimp.Gallery(links, options);

		});
	</script>

	<!-- The Gallery as lightbox dialog, should be a child element of the document body -->
	<div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls">
		<div class="slides"></div>
		<h3 class="title"></h3>
		<a class="prev">‹</a>
		<a class="next">›</a>
		<a class="close">×</a>
		<a class="play-pause"></a>
		<ol class="indicator"></ol>
	</div>

	<script type="text/javascript"><!--
		function price_format(n) {
			c = <?php echo (empty($currency['decimals']) ? "0" : $currency['decimals'] ); ?>;
			d = '<?php echo $currency['decimal_point']; ?>'; // decimal separator
			t = '<?php echo $currency['thousand_point']; ?>'; // thousands separator
			s_left = '<?php echo $currency['symbol_left']; ?>';
			s_right = '<?php echo $currency['symbol_right']; ?>';

			n = n * <?php echo $currency['value']; ?>;

			//sign = (n < 0) ? '-' : '';

			//extracting the absolute value of the integer part of the number and converting to string
			i = parseInt(n = Math.abs(n).toFixed(c)) + '';

			j = ((j = i.length) > 3) ? j % 3 : 0;
			return s_left + (j ? i.substr(0, j) + t : '') + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : '') + s_right;
		}

		function calculate_tax(price) {
			<?php // Process Tax Rates
			if (isset($tax_rates) && $tax) {
				foreach ($tax_rates as $tax_rate) {
					if ($tax_rate['type'] == 'F') {
						echo 'price += '.$tax_rate['rate'].';';
					} elseif ($tax_rate['type'] == 'P') {
						echo 'price += (price * '.$tax_rate['rate'].') / 100.0;';
					}
				}
			}
			?>
			return price;
		}

		function process_discounts(price, quantity) {
			<?php
			foreach ($dicounts_unf as $discount) {
				echo 'if ((quantity >= '.$discount['quantity'].') && ('.$discount['price'].' < price)) price = '.$discount['price'].';'."\n";
			}
			?>
			return price;
		}

		animate_delay = 20;

		main_price_final = calculate_tax(Number($('#formated_price').attr('price')));
		main_price_start = calculate_tax(Number($('#formated_price').attr('price')));
		main_step = 0;
		main_timeout_id = 0;

		function animateMainPrice_callback() {
			main_price_start += main_step;

			if ((main_step > 0) && (main_price_start > main_price_final)){
				main_price_start = main_price_final;
			} else if ((main_step < 0) && (main_price_start < main_price_final)) {
				main_price_start = main_price_final;
			} else if (main_step == 0) {
				main_price_start = main_price_final;
			}

			$('#formated_price').html( price_format(main_price_start) );

			if (main_price_start != main_price_final) {
				main_timeout_id = setTimeout(animateMainPrice_callback, animate_delay);
			}
		}

		function animateMainPrice(price) {
			main_price_start = main_price_final;
			main_price_final = price;
			main_step = (main_price_final - main_price_start) / 10;

			clearTimeout(main_timeout_id);
			main_timeout_id = setTimeout(animateMainPrice_callback, animate_delay);
		}


		<?php if ($special) { ?>
		special_price_final = calculate_tax(Number($('#formated_special').attr('price')));
		special_price_start = calculate_tax(Number($('#formated_special').attr('price')));
		special_step = 0;
		special_timeout_id = 0;

		function animateSpecialPrice_callback() {
			special_price_start += special_step;

			if ((special_step > 0) && (special_price_start > special_price_final)){
				special_price_start = special_price_final;
			} else if ((special_step < 0) && (special_price_start < special_price_final)) {
				special_price_start = special_price_final;
			} else if (special_step == 0) {
				special_price_start = special_price_final;
			}

			$('#formated_special').html( price_format(special_price_start) );

			if (special_price_start != special_price_final) {
				special_timeout_id = setTimeout(animateSpecialPrice_callback, animate_delay);
			}
		}

		function animateSpecialPrice(price) {
			special_price_start = special_price_final;
			special_price_final = price;
			special_step = (special_price_final - special_price_start) / 10;

			clearTimeout(special_timeout_id);
			special_timeout_id = setTimeout(animateSpecialPrice_callback, animate_delay);
		}
		<?php } ?>


		function recalculateprice() {
			var main_price = Number($('#formated_price').attr('price'));
			var input_quantity = Number($('input[name="quantity"]').val());
			var special = Number($('#formated_special').attr('price'));
			var tax = 0;

			if (isNaN(input_quantity)) input_quantity = 0;

			// Process Discounts.
			<?php if ($special) { ?>
			special = process_discounts(special, input_quantity);
			<?php } else { ?>
			main_price = process_discounts(main_price, input_quantity);
			<?php } ?>
			tax = process_discounts(tax, input_quantity);


			<?php if ($points) { ?>
			var points = Number($('#formated_points').attr('points'));
			$('input:checked,option:selected').each(function() {
				if ($(this).attr('points')) points += Number($(this).attr('points'));
			});
			$('#formated_points').html(Number(points));
			<?php } ?>

			var option_price = 0;

			$('input:checked,option:selected').each(function() {
				if ($(this).attr('price_prefix') == '=') {
					option_price += Number($(this).attr('price'));
					main_price = 0;
					special = 0;
				}
			});

			$('input:checked,option:selected').each(function() {
				if ($(this).attr('price_prefix') == '+') {
					option_price += Number($(this).attr('price'));
				}
				if ($(this).attr('price_prefix') == '-') {
					option_price -= Number($(this).attr('price'));
				}
				if ($(this).attr('price_prefix') == 'u') {
					pcnt = 1.0 + (Number($(this).attr('price')) / 100.0);
					option_price *= pcnt;
					main_price *= pcnt;
					special *= pcnt;
				}
				if ($(this).attr('price_prefix') == '*') {
					option_price *= Number($(this).attr('price'));
					main_price *= Number($(this).attr('price'));
					special *= Number($(this).attr('price'));
				}
			});

			special += option_price;
			main_price += option_price;

			<?php if ($special) { ?>
			tax = special;
			<?php } else { ?>
			tax = main_price;
			<?php } ?>

			// Process TAX.
			main_price = calculate_tax(main_price);
			special = calculate_tax(special);

			// Раскомментировать, если нужен вывод цены с умножением на количество
			main_price *= input_quantity;
			special *= input_quantity;
			tax *= input_quantity;

			// Display Main Price
			//$('#formated_price').html( price_format(main_price) );
			animateMainPrice(main_price);

			<?php if ($special) { ?>
			//$('#formated_special').html( price_format(special) );
			animateSpecialPrice(special);
			<?php } ?>

			<?php if ($tax) { ?>
			$('#formated_tax').html( price_format(tax) );
			<?php } ?>
		}

		$(document).ready(function() {
			$('input[type="checkbox"]').bind('change', function() { recalculateprice(); });
			$('input[type="radio"]').bind('change', function() { recalculateprice(); });
			$('select').bind('change', function() { recalculateprice(); });

			$quantity = $('input[name="quantity"]');
			$quantity.data('val', $quantity.val());
			(function() {
				if ($quantity.val() != $quantity.data('val')){
					$quantity.data('val',$quantity.val());
					recalculateprice();
				}
				setTimeout(arguments.callee, 250);
			})();

			recalculateprice();
		});
		//--></script>
<?php echo $footer; ?>
