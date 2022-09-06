
	<div id="fh5co-contact-section">
		<div class="container">
		<div class="row">
			<div class="col-md-6">
				<img style="width:100%" class="my-auto" src="assets/images/map.png" alt="Map"/>
			</div>
			<div class="col-md-6">
				<div class="col-md-12">
					<h3>Our Address</h3>
					<ul class="contact-info">
						<li><i class="ti-map"></i>198 West 21th Street, Suite 721 Tokyo 10016</li>
						<li><i class="ti-mobile"></i>+ 1235 2355 98</li>
					</ul>
				</div>
				<div class="col-md-12">
					<div class="row">
						<form action="#">
							<?php
								$ispis = "";
								if(!isset($_SESSION["user"])){
									$ispis .= '<div class="col-md-12"><h2 class="orange">Please log in to be able to write a message or recension.</h2></div>
									<div class="col-md-12">
									<div class="form-group">
										<textarea name="userMessage" class="form-control" cols="30" rows="7" placeholder="Message" disabled></textarea>
									</div>
									</div>';
								}
								else{
									$ispis .= '
									<div class="col-md-12">
									<div class="form-group">
										<textarea name="userMessage" class="form-control" id="userMessage" cols="30" rows="7" placeholder="Message"></textarea>
										<span></span>
									</div>
									</div>';
								}
								echo $ispis;
							?>
							<div class="col-md-12">
								<div class="form-group">
									<input type="button" id="message" name ="message" value="Send Message" class="btn btn-primary"/>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		</div>
	</div>
	