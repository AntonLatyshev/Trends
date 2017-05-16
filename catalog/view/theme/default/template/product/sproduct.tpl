<?php echo $header; ?>

	<main id="main">
		<?php if ($service_all) { ?>
		<div class="image-top services-apple-iphone-all">
		<?php } else { ?>
		<div class="image-top" style="background-image: url('<?php echo $thumb_bg; ?>');">
		<?php } ?>
			<div class="image-holder">
				<ul class="breadcrumbs">
					<?php foreach ($breadcrumbs as $i=> $breadcrumb) { ?>
						<li><?php if($i+1<count($breadcrumbs)) { ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a> <?php } else { ?><span><?php echo $breadcrumb['text']; ?></span><?php } ?></li>
					<?php } ?>
				</ul>
				<?php if (!$service_all) { ?>
				<span class="title-text"><?php echo $heading_title; ?></span>
				<?php } ?>
			</div>
		</div>
		<?php if ($service_all) { ?>
			<div class="iphone-all-box">
				<ul class="iphone-all-link">
					<?php foreach ($this_service_sproducts as $this_service_sproduct) { ?>
						<?php if ($this_service_sproduct['active']) { ?>
							<li class="active">
								<span class="iphone">
									<div class="link-img">
										<img src="/image/catalog/service/sproduct/all_iphone_img.png" alt="<?php echo $this_service_sproduct['name']; ?>" width="24" height="47">
									</div>
									<div class="name-link">
										<?php echo $this_service_sproduct['name']; ?>
									</div>
								</span>
							</li>
						<?php } else { ?>
							<li>
								<a class="iphone" href="<?php echo $this_service_sproduct['href']; ?>">
									<div class="link-img">
										<img src="/image/catalog/service/sproduct/all_iphone_img.png" alt="<?php echo $this_service_sproduct['name']; ?>" width="24" height="47">
									</div>
									<div class="name-link">
										<?php echo $this_service_sproduct['name']; ?>
									</div>
								</a>
							</li>
						<?php } ?>
					<?php } ?>
				</ul>
			</div>
		<?php } ?>
		<div class="tab-holder iphone-all">
			<div class="top-repairs-box">
				<div class="repairs-box">
					<div class="cooperation-info">
						<span data="<?php echo $heading_title; ?>" class="info-title"><?php echo $heading_title; ?></span>
						<div class="block-text">
							<p><?php echo $description; ?></p>
						</div>
						<span class="read-more">Подробнее<em></em></span>
						<span class="read-more close">Скрыть<em></em></span>
					</div>
					<div class="repairs-img">
						<img src="<?php echo $thumb; ?>" title="<?php echo $heading_title; ?>" alt="<?php echo $heading_title . ' фото'; ?>" width="406" height="347">
					</div>
				</div>
			</div>
			
			<?php if ($sproduct_tab_services) { ?>
			<div class="product-list repairs">
				<ul class="tabset contacts repairs">
					<?php $i=1; foreach ($sproduct_tab_services as $tab => $sproduct_tab_service) { ?>
						<li>
							<a class="tab <?php echo $i==1 ? 'active' : ''; ?>" data="<?php echo $tab; ?>" href="#tab-2<?php echo $i; ?>"><?php echo $tab; ?></a>
						</li>
					<?php $i++; } ?>
				</ul>
				<div class="tab-holder contacts">
					<?php $i=1; foreach ($sproduct_tab_services as $tab => $sproduct_tab_service) { ?>
						<div id="tab-2<?php echo $i; ?>">
							<div class="sliders-box">
								<div class="slider-holder">
									<?php foreach ($sproduct_tab_service as $service) { ?>
										<div class="slider-repair">
											<div class="slider-info">
												<span data="<?php echo $service['name']; ?>" class="info-title"><?php echo $service['name']; ?></span>
												<div class="info-text">
													<p><?php echo $service['description']; ?></p>
												</div>
												<div class="currency-block">
													<span class="currency-service"><em class="number"><?php echo $service['price_min']; ?></em>грн - <em class="number"><?php echo $service['price_max']; ?></em>грн</span>
													<span class="btn-service slider-btn">Заказать</span>
												</div>
											</div>
											<div class="info-img">
												<img src="<?php echo $service['thumb']; ?>" title="<?php echo $service['name']; ?>" alt="<?php echo $service['name'] . ' фото'; ?>" width="276" height="335">
											</div>
										</div>
									<?php } ?>
								</div>
							</div>
						</div>
					<?php $i++; } ?>
				</div>
			</div>
			<?php } ?>

			<?php if ($sproduct_services) { ?>
			<div class="repair-services-title">
				<span class="box-title">ВЫБЕРИТЕ УСЛУГУ</span>
				<span data="Онлайн консультация" class="consultation-link btn-service">Заказать онлайн консультацию</span>
			</div>
			<ul class="repair-services-box">
				<?php foreach ($sproduct_services as $sproduct_service) { ?>
					<li class="service-selection">
						<div class="service-name-price">
							<span class="service-title" data="<?php echo $sproduct_service['name']; ?>"><?php echo $sproduct_service['name']; ?></span>
							<span class="currency-service"><em class="number"><?php echo $sproduct_service['price_min']; ?></em>грн - <em class="number"><?php echo $sproduct_service['price_max']; ?></em>грн</span>
						</div>
						<div class="service-infobox">
							<div class="service-infobox-inner">
								<div class="infobox-links">
									<div class="links-holder">
										<span data="Ремонт в офисе" class="btn-service office">Ремонт в офисе</span>
										<span data="Вызов мастера" class="btn-service master">Вызов мастера</span>
										<span data="Вызов курьера" class="btn-service courier">Вызов курьера</span>
									</div>
									<div class="infobox-img">
										<img src="<?php echo $sproduct_service['thumb']; ?>" width="471" height="353">
									</div>
								</div>
								<div class="infobox-text">
									<span class="infobox-text-click"></span>
									<span class="open-close-icon">
										<span class="vertical-line"></span>
										<span class="horizontal-line"></span>
									</span>
<!--									<div class="mCustomScrollbar" data-mcs-theme="dark">-->
										<div class="holder-text">
											<p><?php echo $sproduct_service['description']; ?></p>
										</div>
<!--									</div>-->
								</div>
							</div>
						</div>
					</li>
				<?php } ?>
			</ul>
			<?php } ?>

			<div class="services-not-found">
				<div class="not-found-form">
					<span class="form-title">НЕ НАШЛИ УСЛУГУ</span>
					<form name="not-found" class="form-faq" id="form-service-nf" action="<?php echo $action_nf; ?>" method="post" enctype="multipart/form-data">
						<input type="tel" name="phone" placeholder="Телефон">
						<div class="phone-nf-danger"></div>

						<textarea name="comment" rows="1" placeholder="Описание поломки"></textarea>
						<div class="comment-nf-danger"></div>

						<button class="submit-form after-add-review">Отправить</button>
						<input type="hidden" name="title_nf" value="<?php echo $heading_title; ?>">
						<input type="hidden" name="subtitle_nf" value="НЕ НАШЛИ УСЛУГУ">
					</form>
				</div>
				<div class="not-found-img">
					<img src="<?php echo $thumb_nf; ?>" width="341" height="402">
				</div>
			</div>

			<div class="services-container">
				<div class="services-container-inner">
					<div class="service-replace">
						<div class="video-box">
							<img src="<?php echo $thumb_add; ?>" width="437" height="508">
							<div class="video-btn-holder">
								<div class="video-waves-holder">
									<div class="video-waves"></div>
									<a class="video-opener">
										<span></span>
									</a>
								</div>
							</div>
						</div>
						<?php if (isset($custom_field['text_iphone2iphone']) && !empty($custom_field['text_iphone2iphone'])) { ?>
						<div class="replace-info">
							<span class="form-title"><?php echo isset($custom_field['title_iphone2iphone']) ? $custom_field['title_iphone2iphone'] : ''; ?></span>
							<div class="mCustomScrollbar" data-mcs-theme="dark">
								<div class="box-text">
									<p>
										<?php echo $custom_field['text_iphone2iphone']; ?>
									</p>
								</div>
							</div>
							<span data="<?php echo isset($custom_field['title_iphone2iphone']) ? $custom_field['title_iphone2iphone'] : ''; ?>" class="btn-service to-order">Заказать</span>
						</div>
						<?php } ?>
					</div>
				</div>
			</div>

			<div class="services-block">
				<ul class="services-holder">
					<li>
						<div class="box-image master"></div>
						<div class="box-info">
							<span class="title-box">ВЫЗОВ МАСТЕРА НА МЕСТО</span>
							<P>
								Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore
							</P>
						</div>
					</li>
					<li>
						<div class="box-image courier"></div>
						<div class="box-info">
							<span class="title-box">ОТПРАВИТЬ КУРЬЕРОМ НА СЕРВИСНЫЙ ЦЕНТР</span>
							<P>
								Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore
							</P>
						</div>
					</li>
					<li>
						<div class="box-image repairs"></div>
						<div class="box-info">
							<span class="title-box">100% КАЧЕСТВО РЕМОНТА</span>
							<P>
								Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore
							</P>
						</div>
					</li>
					<li>
						<div class="box-image original"></div>
						<div class="box-info">
							<span class="title-box">СТАВИМ ТОЛЬКО ОРИГИНАЛЬНЫЕ ДЕТАЛИ</span>
							<P>
								Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore
							</P>
						</div>
					</li>
				</ul>
				<div class="services-box-img">
					<img src="<?php echo $thumb_trigger; ?>" title="disassembled" alt="disassembled" width="328" height="579">
				</div>
			</div>

			<?php if ($images) { ?>
				<div class="gallery-container">
					<span class="box-title">НАША ГАЛЕРЕЯ</span>
					<div class="gallery-box">
						<?php foreach ($images as $image) { ?>
							<div class="gallery-slide">
								<div class="gallery-img">
									<img src="<?php echo $image['thumb']; ?>" title="<?php echo $image['image_description']; ?>" alt="<?php echo $image['image_description'] . ' фото'; ?>" width="768" height="435">
									<span class="img-text"><?php echo $image['image_description']; ?></span>
								</div>
							</div>
						<?php } ?>
					</div>
				</div>
			<?php } ?>

		</div>
	</main>

<?php echo $footer; ?>