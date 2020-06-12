<?php
	include $_SERVER['DOCUMENT_ROOT'].'/config/init.php';
	$header = 'contact';
	$bread = 'Contact';
	include 'inc/header.php';
?>

		<!-- section -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-6">
						<div class="section-row">
							<h3>Contact Information</h3>
							<p>Oh! So, you wanna contact me. Why? I don't see any reason for you to contact me. Why I wanna get in contact with this world burden, who should be dead, not tying to contact me. Ok! Ok! Don't cry! I have left some of my detail down there. Contact me just before dying, I need some reason to celebrate!!</p>
							<ul class="list-style">
								<li><p><strong>Email:</strong> <a href="#"> jpphanju54@gmail.com</a></p></li>
								<li><p><strong>Phone:</strong> Dream About it</p></li>
								<li><p><strong>Address:</strong> Hahaha Why??</p></li>
							</ul>
						</div>
					</div>
					<div class="col-md-5 col-md-offset-1">
						<div class="section-row">
							<h3>Send A Message</h3>
							<form action="process/contact.php" method="POST">  
								<div class="row">
									<div class="col-md-7">
										<div class="form-group">
											<span>Email</span>
											<input class="input" type="email" name="email" required=""/>
										</div>
									</div>
									<div class="col-md-7">
										<div class="form-group">
											<span>Subject</span>
											<input class="input" type="text" name="subject" required=""/>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<textarea class="input" name="message" placeholder="Message" required=""/></textarea>
										</div>
										<button class="primary-button">Submit</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /section -->

<?php
	include 'inc/footer.php';
?>