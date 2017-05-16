<?php echo $header; ?>
<div id="main">
	<div class="image-top" style="background-image: url('<?php echo $thumb_bg; ?>');">
		<div class="image-holder">
			<ul class="breadcrumbs">
				<?php foreach ($breadcrumbs as $i=> $breadcrumb) { ?>
					<li><?php if($i+1<count($breadcrumbs)) { ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a> <?php } else { ?><span><?php echo $breadcrumb['text']; ?></span><?php } ?></li>
				<?php } ?>
			</ul>
			<span class="title-text"><?php echo $heading_title; ?></span>
		</div>
	</div>
	<div class="content-blog">
		<div class="sidebar-content">
			<div class="sidebar-selection">
				<?php echo $column_left; ?>
			</div>

			<?php if ($products_sale) { ?>
				<div class="sale-products">
					<span class="sale-products-title">АКЦИОННЫЕ ТОВАРЫ</span>
					<ul>
					<?php foreach ($products_sale as $product_sale) { ?>
						<li>
							<a href="<?php echo $product_sale['href']; ?>">
								<div class="product-img">
									<img src="<?php echo $product_sale['thumb']; ?>" alt="notebook" width="73" height="69">
								</div>
								<div class="product-info">
									<span class="product-name"><?php echo $product_sale['name']; ?></span>
									<div class="catalog-price">
										<?php if ($product_sale['special']) { ?>
											<span class="old-price"><?php echo $product_sale['price']; ?></span>
											<span class="sale-price"><?php echo $product_sale['special']; ?></span>
										<?php } else { ?>
											<span class="topical-price"><?php echo $product_sale['price']; ?></span>
										<?php } ?>
									</div>
								</div>
							</a>
						</li>
					<?php } ?>
					</ul>
				</div>
			<?php } ?>
		</div>
		<div class="content-all-catalog">
			<?php if ($products) { ?>
				<div class="all-catalog-selection">
					<div class="products-controls">Фильтр</div>
					<div class="select open">
						<label class="form-name">Сортировать:</label>
						<select id="input-sort" class="sortby" onchange="location = this.value;" data-jcf="{&quot;wrapNative&quot;: false, &quot;wrapNativeOnMobile&quot;: false, &quot;fakeDropInBody&quot;: false, &quot;useCustomScroll&quot;: false}">
							<?php foreach ($sorts as $sorts) { ?>
								<?php if ($sorts['value'] == $sort . '-' . $order) { ?>
									<option value="<?php echo $sorts['href']; ?>" selected="selected"><?php echo $sorts['text']; ?></option>
								<?php } else { ?>
									<option value="<?php echo $sorts['href']; ?>"><?php echo $sorts['text']; ?></option>
								<?php } ?>
							<?php } ?>
						</select>
					</div>
					<div class="all-catalog-quantity">
						<div class="quantity-box">
							<label class="form-name">Кол-во товаров:</label>
							<select id="input-limit" class="quantity" onchange="location = this.value;" data-jcf="{&quot;wrapNative&quot;: false, &quot;wrapNativeOnMobile&quot;: false, &quot;fakeDropInBody&quot;: false, &quot;useCustomScroll&quot;: false}">
								<?php foreach ($limits as $limits) { ?>
									<?php if ($limits['value'] == $limit) { ?>
										<option value="<?php echo $limits['href']; ?>" selected="selected"><?php echo $limits['text']; ?></option>
									<?php } else { ?>
										<option value="<?php echo $limits['href']; ?>"><?php echo $limits['text']; ?></option>
									<?php } ?>
								<?php } ?>
							</select>
						</div>
						<div class="all-catalog-view">
							<div class="view-title">Вид:</div>
							<span class="line"></span>
							<span class="tile active"></span>
						</div>
					</div>
				</div>
				<div class="content-catalog">
					<div class="tile-catalog">
						<?php foreach ($products as $product) { ?>
							<div class="catalog-item">
								<div class="image-holder">
									<a href="<?php echo $product['href']; ?>">
										<?php if ($product['promotag']) { ?>
											<span class="catalog-<?php echo $product['promotag']['class']; ?>"><?php echo $product['promotag']['text']; ?></span>
										<?php } ?>
										<div class="catalog-image">
											<img src="<?php echo $product['thumb']; ?>" width="229" height="216">
										</div>
										<?php if ($product['images']) { ?>
											<div class="catalog-image-hover">
												<img src="<?php echo $product['images'][0]; ?>" width="255" height="240">
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
				<?php if ( !empty($pagination) ) { ?>
					<div class="page-nav">
						<?php echo $pagination; ?>
					</div>
				<?php } ?>
			<?php } else { ?>
				<p><?php echo $text_empty; ?></p>
			<?php } ?>
			<?php if ($description) { ?>
				<div class="cooperation-info catalog">
					<span class="info-title"><?php echo $heading_title; ?></span>
					<p><?php echo $description; ?></p>
					<span class="read-more">Подробнее<em></em></span>
					<span class="read-more close">Скрыть<em></em></span>
				</div>
			<?php } ?>
		</div>
	</div>
</div>

<?php echo $footer; ?>
