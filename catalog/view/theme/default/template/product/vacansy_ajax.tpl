<?php foreach($vacansies as $vacansy){ ?>
	<div class="news-item-wrap">
	  <div class="news-item news-item--vacancies">
		<div class="news-date-box news-date-box--vacancies">
					  <div class="news-date-box__month"><?php echo $vacansy['vac_date_mass'][1]; ?></div>
					  <div class="news-date-box__day news-date-box__day--vacancies"><?php echo $vacansy['vac_date_mass'][2]; ?></div>
					  <div class="news-date-box__year"><?php echo $vacansy['vac_date_mass'][0]; ?></div>
		</div>
		<div class="news-item-content news-item-content--vacancies">
		  <div class="news-item-text">
			<div class="news-item-text__text">
			  <h2><?php echo $vacansy['vac_name']; ?></h2>
			  <p><?php echo $vacansy['vac_schort_text']; ?></p>
			</div>
			<div class="btn-wrap btn-wrap--left">
			  <div class="btn-holder">
				<a href="<?php echo $vacansy['vac_link'];?>" class="learn-more"><?php echo $button_details;?></a>
			  </div>
			</div>
		  </div>
		</div>
	  </div>
	</div>
<?php }	?>  