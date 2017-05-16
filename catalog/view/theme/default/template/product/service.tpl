<?php echo $header; ?>
<main id="main">
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
	<div class="content-blog services">

		<?php echo $content_top; ?>

		<?php if ($sproducts) { ?>
			<ul class="all-services">
				<?php foreach ($sproducts as $sproduct) { ?>
					<li class="service-block">
						<a href="<?php echo $sproduct['href']; ?>">
							<span class="open-nav-service">
								<div class="service-img">
									<img src="<?php echo $sproduct['thumb']; ?>" title="<?php echo $sproduct['name']; ?>" alt="<?php echo $sproduct['name']; ?>" width="112" height="162">
								</div>
								<span class="service-box-title"><?php echo $sproduct['name']; ?></span>
							</span>
						</a>
						<div class="service-box">
							<div class="service-text">
								<p>
									<?php echo $sproduct['short_description']; ?>
								</p>
							</div>
						</div>
					</li>
				<?php } ?>
			</ul>
		<?php } elseif ($services) { ?>
			<ul class="all-services">
				<?php foreach ($services as $service) { ?>
					<li class="service-block">
						<a href="<?php echo $service['href']; ?>">
						<span class="open-nav-service">
							<div class="service-img">
								<img src="<?php echo $service['thumb']; ?>" title="<?php echo $service['name']; ?>" alt="<?php echo $service['name']; ?>" width="241" height="143">
							</div>
							<span class="service-box-title"><?php echo $service['name']; ?></span>
						</span>
						</a>
						<div class="service-box">
							<div class="service-text">
								<p>
									<?php echo $service['short_description']; ?>
								</p>
							</div>
							<?php if (!empty($service['sub_services'])) { ?>
								<ul class="nav-service">
									<?php foreach ($service['sub_services'] as $sub_service) { ?>
										<li>
											<a href="<?php echo $sub_service['href']; ?>"><?php echo $sub_service['name']; ?></a>
										</li>
									<?php } ?>
									<li>
										<a href="<?php echo $service['href']; ?>" class="all-link"><?php echo $text_all; ?><em></em></a>
									</li>
								</ul>
							<?php } ?>
						</div>
					</li>
				<?php } ?>
			</ul>
		<?php } else { ?>
			<p><?php echo $text_empty; ?></p>
		<?php } ?>
	</div>

	<?php if ($level == 1) echo $content_bottom; ?>

	<?php if ($description) { ?>
		<div class="content-bottom">
			<div class="content-bottom-holder">
				<div class="image-box">
					<img src="<?php echo $thumb; ?>" width="555" height="574" alt="<?php echo $heading_title; ?>">
				</div>
				<div class="content-bottom-box">
					<h1 class="box-title"><?php echo $heading_title; ?></h1>
					<div class="mCustomScrollbar" data-mcs-theme="dark">
						<div class="box-text">
							<p>
								<?php echo $description; ?>
							</p>
						</div>
					</div>
					<a href="#" class="go-services"><?php echo $text_more; ?><em></em></a>
				</div>
			</div>
		</div>
	<?php } ?>
</main>

<?php echo $footer; ?>
