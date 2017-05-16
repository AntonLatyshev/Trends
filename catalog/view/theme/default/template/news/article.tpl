<div class="blog-holder">
	<?php if ($thumb) { ?>
		<div class="content-img">
			<img src="<?php echo $thumb; ?>" alt="<?php echo $heading_title; ?>" width="775" height="480">
		</div>
	<?php } ?>
	<div class="content-info">
		<span class="content-data"><?php echo $date_added; ?></span>
		<span class="content-title"><?php echo $heading_title; ?></span>
		<?php echo $description; ?>
	</div>
	<?php if ($gallery_images) { ?>
		<div class="double-slider">
			<div class="blog-big-slider">
				<?php foreach ($gallery_images as $gallery) { ?>
					<div class="slide-img">
						<img src="<?php echo $gallery['thumb']; ?>" alt="<?php echo $gallery['text']; ?>" width="566" height="399">
					</div>
				<?php } ?>
			</div>
			<div class="blog-mini-slider">
				<?php foreach ($gallery_images as $gallery) { ?>
					<div class="slide-img">
						<img src="<?php echo $gallery['thumb_slider']; ?>" alt="<?php echo $gallery['text']; ?>" width="103" height="78">
					</div>
				<?php } ?>
			</div>
		</div>
	<?php } ?>
	<div class="social-box">
		<span class="share"><?php echo $text_share; ?></span>
		<div class="share42init"></div>
	</div>
</div>
