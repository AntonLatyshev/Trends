<div class="hidden-item-edit">
	<div class="hidden-item-overlay"></div>
	<div class="hidden-item-holder">
		<div class="close-feedback"></div>
		<?php if (!empty($product)) { ?>
			<input type="hidden" id="key" value="<?php echo $product['key']; ?>">
			<div class="item-image">
				<img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" width="149" height="288">
			</div>
			<div class="item-info">
				<span class="item-name">
					<?php echo $product['name']; ?>
				</span>
				<div class="calculation-box-holder">
					<div class="calculation-box">
						<div class="unit">
							<span class="unit-name"><?php echo $text_price; ?></span>
							<span class="unit-price"><?php echo $product['price']; ?></span>
						</div>
						<div class="quantity-block">
							<span class="unit-name"><?php echo $text_quantity; ?></span>
							<div class="quantity" data-key="<?php echo $product['key']; ?>">
								<input name="quantity" type="number" value="<?php echo $product['quantity']; ?>" min="1" max="200" step="1">
							</div>
						</div>
						<div class="total">
							<span class="unit-name"><?php echo $text_total; ?></span>
							<span class="total-price"><?php echo $product['total']; ?></span>
						</div>
					</div>
				</div>
				<div class="checkout-box">
					<button class="checkout"><?php echo $button_save; ?></button>
				</div>
			</div>
		<?php } ?>
	</div>
</div>

<script>
	$('.close-feedback, .hidden-item-overlay').click(function() {
		$('.hidden-item-edit').hide();
	});

	$('.checkout').click(function() {
		updateCart();
		$('.hidden-item-edit').hide();
	});
</script>
