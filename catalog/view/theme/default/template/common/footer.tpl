<footer id="footer">
	<div class="footer-top">
		<div class="footer-nav-holder">
			<div class="footer-nav">
				<ul class="footer-nav-box">
					<li><a href="#"><?php echo $text_catalog; ?></a>
					</li>
					<li><a href="<?php echo $service_page['href']; ?>"><?php echo $service_page['title']; ?></a>
					</li>
					<li><a href="<?php echo $about_page['href']; ?>"><?php echo $about_page['title']; ?></a>
					</li>
					<li><a href="<?php echo $contacts['href']; ?>"><?php echo $contacts['title']; ?></a>
					</li>
					<li><a href="<?php echo $delivery_page['href']; ?>"><?php echo $delivery_page['title']; ?></a>
					</li>
					<li><a href="<?php echo $payment_page['href']; ?>"><?php echo $payment_page['title']; ?></a>
					</li>
					<li><a href="<?php echo $help_page['href']; ?>"><?php echo $help_page['title']; ?></a>
					</li>
					<li><a href="<?php echo $blog_page['href']; ?>"><?php echo $blog_page['title']; ?></a>
					</li>
				</ul>
			</div>
		</div>
		<div class="info-box">
			<div class="box-development">
				<strong class="development-img"><a href="https://art-lemon.com" target="_blank"></a></strong>
				<div class="development-text">
					<p><?php echo $developers; ?></p>
				</div>
			</div>
			<div class="method-box">
				<div class="delivery-method">
					<span class="method-name"><?php echo $text_delivery; ?></span>
					<ul class="method-img">
						<li>
							<span class="delivery-nova"></span>
						</li>
						<li>
							<span class="delivery-mist"></span>
						</li>
					</ul>
				</div>
				<div class="payment-method">
					<span class="method-name"><?php echo $text_payment; ?></span>
					<ul class="method-img">
						<li>
							<span class="payment-visa"></span>
						</li>
						<li>
							<span class="payment-master"></span>
						</li>
						<li>
							<span class="payment-privat"></span>
						</li>
						<li>
							<span class="payment-liqpay"></span>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="footer-bottom">
		<div class="footer-bottom-holder">
			<div class="contacts-box">
				<div class="address-box">
					<address class="address"><em></em><?php echo $address; ?></address>
				</div>
				<strong class="footer-logo"><a href="/"></a></strong>
				<div class="phone-box">
					<span class="phone"><a href="tel:<?php echo $telephone_digit_2; ?>"><em></em><?php echo $telephone_2; ?></a></span>
					<span class="phone"><a href="tel:<?php echo $telephone_digit; ?>"><?php echo $telephone; ?></a></span>
				</div>
			</div>
			<div class="footer-social">
				<ul>
					<li>
						<a href="<?php echo $config_facebook; ?>" class="facebook" target="_blank"></a>
					</li>
					<li>
						<a href="<?php echo $config_google; ?>" class="google" target="_blank"></a>
					</li>
					<li>
						<a href="<?php echo $config_vk; ?>" class="vk" target="_blank"></a>
					</li>
					<li>
						<a href="<?php echo $config_instagram; ?>" class="instagram" target="_blank"></a>
					</li>
				</ul>
			</div>
			<div class="copyright">
				<?php echo $powered; ?>
			</div>
		</div>
	</div>
</footer>
<?php echo $modals ?>
</div>


<script type="text/javascript" src="/catalog/view/javascript/vendor/slick-carousel/slick/slick.js"></script>
<script type="text/javascript" src="/catalog/view/javascript/vendor/tabs.js"></script>
<script type="text/javascript" src="/catalog/view/javascript/vendor/accordion.js"></script>
<script type="text/javascript" src="/catalog/view/javascript/vendor/jquery.maskedinput-1.3.min.js"></script>
<script type="text/javascript" src="/catalog/view/javascript/vendor/share42/share42.js"></script>
<script type="text/javascript" src="/catalog/view/javascript/vendor/jcf/dist/js/jcf.js"></script>
<script type="text/javascript" src="/catalog/view/javascript/vendor/jcf/dist/js/jcf.number.js"></script>
<script type="text/javascript" src="/catalog/view/javascript/vendor/jcf/dist/js/jcf.select.js"></script>
<script type="text/javascript" src="/catalog/view/javascript/vendor/fancybox/dist/jquery.fancybox.min.js"></script>
<script type="text/javascript" src="/catalog/view/javascript/vendor/malihu-custom-scrollbar-plugin-master/jquery.mCustomScrollbar.concat.min.js"></script>
<script type="text/javascript" src="/catalog/view/javascript/vendor/jquery.countdown.js"></script>
<script type="text/javascript" src="/catalog/view/javascript/vendor/nouislider/distribute/nouislider.min.js"></script>
<script type="text/javascript" src="/catalog/view/javascript/app.js"></script>
<script type="text/javascript" src="/catalog/view/javascript/main.js"></script>
<script type="text/javascript" src="/catalog/view/javascript/livesearch.js"></script>
<script type="text/javascript" src="/catalog/view/javascript/jquery.validate.js"></script>
<script type="text/javascript" src="/catalog/view/javascript/send_form.js"></script>

<script src="/catalog/view/javascript/checkout/vendor/modernizr.js"></script>
<script src="/catalog/view/javascript/checkout/alert.js"></script>
<script src="/catalog/view/javascript/checkout/button.js"></script>
<script src="/catalog/view/javascript/checkout/app.js"></script>

</body>
</html>
