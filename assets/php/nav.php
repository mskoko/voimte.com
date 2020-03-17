<!-- NAV BAR FOR MOBILE -->
<div class="main_menu">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<nav class="navbar navbar-expand-lg navbar-light">
					<ul class="navbar-nav">
						<div class="cntrNav">
							<li class="nav-item">
								<a class="nav-link <?php echo get_active_link('feed'); ?>" href="/feed">
									Voimte.com
								</a>
							</li>
						</div>

						<div class="container">
							<div class="row">
								<div class="col-md-5 input-group s_prjct" id="s_prjct">
									<?php if (!($User->IsLoged()) == false) { ?>
										<input id="is_clicked" type="text" name="s" onchange="s_muky(this.value)" onkeyup="s_muky(this.value)" onclick="view_s_box()" class="form-control s_not_act1" placeholder="Search .." required="">
										<div class="input-group-append">
											<span class="btn s_not_act2" type="button">
												<i class="fa fa-search"></i>
											</span>
										</div>
									<?php } ?>

									<div class="s_box" style="display:none;">
										<div id="s_result">
											Search ..
										</div>

										<hr style="width:100%;">

										<li style="background:#e2e2e2;width:100%;margin-top:10px;text-align:center;">
											<a href="">vidi sve</a>
										</li>
									</div>
								</div>
								
								<div class="col-md-2"><div class="clear" style="margin-top:10px;"></div></div>

								<div class="col-md-5">
									<div class="cntrNav">
										<?php if (!($User->IsLoged()) == false) { ?>
											<li class="nav-item">
												<a class="nav-link <?php echo get_active_link('user', '1'); ?>" href="/@<?php echo $Secure->SecureTxt($User->UserData()['Username']); ?>">
													<i class="fa fa-user"></i> <span class="hide_for_phone"><?php echo $Secure->SecureTxt($User->UserData()['Username']); ?></span>
												</a>
											</li>

											<li class="nav-item">
												<a class="nav-link <?php echo get_active_link('settings'); ?>" href="/settings">
													<i class="fa fa-cog"></i> <span class="hide_for_phone">Settings</span>
												</a>
											</li>

											<li class="nav-item">
												<a class="nav-link" href="/logout.php">
													<i class="fa fa-sign-out"></i> <span class="hide_for_phone">Sign out</span>
												</a>
											</li>
										<?php } else { ?>
											<li class="nav-item">
												<a class="nav-link js-scroll-trigger <?php echo get_active_link('login'); ?>" href="/login">
													<i class="fa fa-sign-in"></i> Sign in
												</a>
											</li>

											<li class="nav-item">
												<a class="nav-link js-scroll-trigger <?php echo get_active_link('register'); ?>" href="/register">
													<i class="fa fa-user-plus"></i> Sign up
												</a>
											</li>
										<?php } ?>
									</div>
								</div>
							</div>
						</div>

					</ul>
				</nav>
			</div>
		</div>
	</div>
</div>
<!-- END OF NAV BAR FOR MOBILE -->