<div class="clearfix" style="margin-top:100px;"></div>

<!-- copyright -->
<footer>
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-12">
				<div class="footer_nav">
					<li><a href="/privacy">Privacy Policy</a></li>
					<li><a href="/terms">Terms and Conditions</a></li>
					<li><a href="/about">About</a></li>
					<li><a href="mailto:mskoko.me@gmail.com">Contact</a></li>
				</div>
			</div>
	
			<br> <br>

			<div class="col-md-12">
				<div class="footer_voimte">
					<p><?php echo $Site->SiteConfig()['site_link']; ?> <small>&copy; <?php echo date('Y'); ?></small></p>
				</div>
			</div>
		</div>
	</div>
</footer>

<?php if(!isset($_COOKIE['accept_cookie'])) { ?>
	<!-- Coccie access -->
	<div id="alert_cookies" class="alert_cookies" style="display:none;">
		<div class="row">
			<div class="col-12 col-lg-10">
				<b>Voimte.com serve cookies</b> <br>
				<p>We uses "cookies" to provide services in accordance with our <a href="/privacy">Privacy Policy</a>. By continuing to use the site, you agree to the use of <a href="">cookies</a></p>
			</div>

			<div class="col-12 col-lg-2">
				<div class="alert_cookies_btn">
					<li>
						<a href="javascript:;" class="accept" onclick="cookie_alert('1')">Accept</a>
					</li>

					<li>
						<a href="javascript:;" onclick="cookie_alert('0')">Decline</a>
					</li>
				</div>
			</div>
		</div>
	</div>
<?php } ?>


<!-- Javascript -->
	<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	
	<script src="//cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

	<script src="//stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

	<!-- APP -->
	<script src="/assets/js/app.js?<?php echo time(); ?>"></script>

	<!-- Global site tag (gtag.js) - Google Analytics -->
	<!--<script async src="https://www.googletagmanager.com/gtag/js?id=G-DMYDEXR8GZ"></script>-->
	<script>
		/*window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'G-DMYDEXR8GZ');*/
	</script>