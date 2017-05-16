<div class="hidden-item-overlay"></div>
<div class="hidden-item-holder">
	<span class="hidden-item-close"></span>
	<div class="item-image">
		<img src="<?php echo $product['image']; ?>" width="170" height="269">
	</div>
	<div class="item-info">
		<span class="item-name"><?php echo $product['name']; ?></span>
		<span class="added-to-cart"><em></em><?php echo $text_add_success; ?></span>
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
		<div class="checkout-box">
			<span class="continue-shopping"><?php echo $button_continue; ?></span>
			<a href="<?php echo $checkout; ?>" class="checkout"><span><?php echo $button_checkout; ?></a>
		</div>
	</div>
</div>