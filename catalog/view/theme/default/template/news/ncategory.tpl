<?php if ($article) { ?>
	<ul class="blog-articles">
		<?php foreach ($article as $articles) { ?>
			<li class="slide-news-box">
				<div class="news-box-img">
					<a href="<?php echo $articles['href']; ?>">
						<img src="<?php echo $articles['thumb']; ?>" alt="<?php echo $articles['name']; ?>" width="413" height="213">
					</a>
				</div>
				<div class="news-box-info">
					<span class="info-date"><?php echo $articles['date_added']; ?></span>
					<a href="<?php echo $articles['href']; ?>"><?php echo $articles['name']; ?></a>
					<div class="info-text">
						<p><?php echo $articles['description']; ?></p>
					</div>
				</div>
			</li>
		<?php } ?>
	</ul>
	
	<?php if (!empty($pagination)) { ?>
		<div class="page-nav">
			<?php echo $pagination; ?>
		</div>
	<?php } ?>

<?php } else { ?>
	<div class="c_error"><?php echo $text_empty; ?></div>
<?php } ?>
