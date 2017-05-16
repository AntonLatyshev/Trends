<?php echo $header; ?>

	<main id="main">
		<div class="image-top" style="background-image: url('/images/top_vacancies_bg.jpg');">
			<div class="image-holder">
				<ul class="breadcrumbs">
					<?php foreach ($breadcrumbs as $i=> $breadcrumb) { ?>
						<li><?php if($i+1<count($breadcrumbs)) { ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a> <?php } else { ?><span><?php echo $breadcrumb['text']; ?></span><?php } ?></li>
					<?php } ?>
				</ul>
				<span class="title-text"><?php echo $heading_title; ?></span>
			</div>
		</div>
		<div class="product-list vacancies">
			<?php if ($vacansies) { ?>
				<ul class="tabset">
					<?php $i = 1; foreach ($vacansies as $key => $vacansy) { ?>
						<li>
							<a class="tab <?php echo $i == 1 ? 'active' : ''; ?>" href="#tab-1<?php echo $i; ?>"><?php echo $key; ?></a>
						</li>
					<?php $i++; } ?>
				</ul>
				<div class="tab-holder vacancies">
					<?php $i = 1; foreach ($vacansies as $key => $vacansy) { ?>
						<div id="tab-1<?php echo $i; ?>">
							<div class="content-faq">
								<ul>
									<?php foreach ($vacansy as $vacansy_item) { ?>
										<li class="question">
											<span class="question-title"><?php echo $vacansy_item['vac_name']; ?></span>
											<div class="answer">
												<p><?php echo $vacansy_item['vac_requirements']; ?></p>
												<a href="#" class="summary-link"><?php echo $button_sent_rez; ?></a>
											</div>
										</li>
									<?php } ?>
									<li class="not-found">
										<span class="question-title"><?php echo $text_not_found; ?></span>
										<p><?php echo $text_not_found_sub; ?></p>
										<a href="#" class="summary-link"><?php echo $button_sent_rez; ?></a>
									</li>
								</ul>
							</div>
						</div>
					<?php $i++; } ?>
				</div>
			<?php } else { ?>
				<?php echo $text_no_vac; ?>
			<?php } ?>
		</div>
	</main>

<?php echo $footer; ?>