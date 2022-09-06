    <aside id="fh5co-hero" class="js-fullheight">
        <div class="flexslider js-fullheight">
            <ul class="slides">
				<?php
					$ispis = "";
						foreach($sobe as $soba){
							$ispis .= '<li class="cover'.$soba->id_room.'">
										<div class="overlay-gradient"></div>
											<div class="container">
												<div class="col-md-12 col-md-offset-0 text-center slider-text">
													<div class="slider-text-inner js-fullheight">
														<div class="desc">
															<p><span>Aden Hotel</span></p>
															<h2>'.$soba->room_name.'</h2>
															<p>
																<a href="index.php?page=accommodation&idRoom='.$soba->id_room.'" class="btn btn-primary btn-lg">Book Now</a>
															</p>
													</div>
												</div>
											</div>
										</div>
									</li>';
							}
					echo $ispis;
				?>
            </ul>
        </div>
    </aside>
	
	<div id="fh5co-counter-section" class="fh5co-counters">
		<div class="container">
			<div class="row">
			<?php
				$niz = array (
					array("User Access" => 20356),
					array("Hotels" => 1550),
					array("Transactions" => 8200),
					array("Rating &amp; Review" => 8763)
				  );
				  foreach($niz as $n){
					foreach($n as $text => $num){
						echo ("<div class='col-md-3 text-center'>
						<span class='fh5co-counter js-counter' data-from='0' data-to='$num' data-speed='5000' data-refresh-interval='50'></span>
						<span class='fh5co-counter-label'>$text</span>
						</div>");
					}
				  }
			?>
			</div>
		</div>
	</div>

	<div id="featured-hotel" class="fh5co-bg-color">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="section-title text-center">
						<h2>Featured Rooms</h2>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="feature-full-1col">
					<div class="image cover1">
						<div class="descrip text-center">
							<p><small>For as low as</small><span>96.000 &yen;/night</span></p>
						</div>
					</div>
					<div class="desc">
							<?php
								$soba = pojedinacnaSoba(1);
								$ispis = "
								<h3>$soba->room_name</h3>
								<p>$soba->description</p>
								<p><a href='accommodation.php?idRoom=$soba->id_room' class='btn btn-primary btn-luxe-primary'>Book Now <i class='ti-angle-right'></i></a></p>
								";
								echo $ispis;
							?>
					</div>
				</div>
				<div class="feature-full-2col">
					<?php
						$ispis = "";
						foreach($sobe as $s){
							if($s->id_room == 2 || $s->id_room == 3){
								$ispis .= "<div class='f-hotel'>
								   <div class='image cover$s->id_room'>
									   <div class='descrip text-center'>
										   <p><small>For as low as</small><span>96.000 &yen;/night</span></p>
									   </div>
								   </div>
								   <div class='desc'>
									   <h3>$s->room_name</h3>
									   <p>$s->description</p>
									   <p><a href='index.php?page=accommodation&idRoom=$s->id_room' class='btn btn-primary btn-luxe-primary'>Book Now <i class='ti-angle-right'></i></a></p>
								   </div>
							   </div>";
							}
						}
						echo $ispis;
					?>
				</div>
			</div>
		</div>
	</div>

	<div id="hotel-facilities">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="section-title text-center">
						<h2>Hotel Facilities</h2>
					</div>
				</div>
			</div>

			<div id="tabs">
				<nav class="tabs-nav">
				<?php
					$facilities = vratiSve("facilities");
					$ispis1 = "";
					$i1 = 1;
						foreach($facilities as $fac):
							if($i1 == 1){
								$ispis1 .= '<a href="#" class="active" data-tab="tab'.$i1.'">';
							}
							else{
								$ispis1 .= '<a href="#" data-tab="tab'.$i1.'">';
							}
							$ispis1 .='<i class="'.$fac->icon.'"></i>
										<span>'.$fac->name.'</span>
									</a>';
							$i1++;
						endforeach;
						echo($ispis1);	
				?>
					
				</nav>

				<div class="tab-content-container">

					<?php
						$ispis = "";
						$i = 1;
					foreach($facilities as $fac):
						if($i == 1){
							$ispis .= '<div class="tab-content active show" data-tab-content="tab'.$i.'">';
						}
						else{
							$ispis .= '<div class="tab-content" data-tab-content="tab'.$i.'">';
						}
						$ispis .= '<div class="container">
									<div class="row">
										<div class="col-md-6">
											<img src="assets/'. $fac->pic_src .'" class="img-responsive" alt="'. $fac->name .'">
										</div>
										<div class="col-md-6">
											<span class="super-heading-sm">World Class</span>
											<h3 class="heading">'. $fac->name .'</h3>
											<p>'. $fac->text .'</p>
											<p class="service-hour">
												<span>Service Hours</span>
												<strong>7:30 AM - 8:00 PM</strong>
											</p>
										</div>
									</div>
								</div>
							</div>';
					$i++;
					endforeach;
					echo($ispis);
						
					?> 
				</div>
			</div>
		</div>
	</div>

	<div id="testimonial">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="section-title text-center">
						<h2>Happy Guests Says...</h2>
					</div>
				</div>
			</div>
			<div  id="topKomentari" class="row">
			<?php
				$poruke = topMessages();
				$ispis = "";
				foreach($poruke as $por){
					$ispis .= "<div class='col-md-6'>
						<div class='testimony'>
							<blockquote>
								&ldquo;$por->message&rdquo;
							</blockquote>
							<p class='author'><cite>$por->first_name $por->last_name</cite></p>
						</div>
					</div>";
				}
				echo($ispis);
			?>
			</div>
			<nav aria-label="Page navigation example">
				<ul class="pagination">
					<li class="page-item"><a class="page-link komentari" href="#" data-limit="0">1</a></li>
					<li class="page-item"><a class="page-link komentari" href="#" data-limit="2">2</a></li>
				</ul>
			</nav>
		</div>
	</div>

	<div id="fh5co-services-section">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="section-title text-center"><br/><br/>
						<h2>Hotel Services</h2>
					</div>
				</div>
			</div>
			<div class="row">
			<?php
				$services = array (
					array("TV" => "icon-tv"),
					array("Open 24/7" => "ti-alarm-clock"),
					array("Reservation" => "ti-calendar"),
					array("Friendly Staff" => "ti-user"),
					array("Free Wifi" => "ti-signal"),
					array("Accessible Location" => "ti-location-pin")
				  );
				  foreach($services as $serv){
					foreach($serv as $text => $icon){
						echo ("<div class='col-md-4 services'>
								<div class='services'>
									<span><i class='$icon'></i></span>
									<div class='desc'><br/>
										<h3>$text</h3>
									</div>
								</div></div>");
					}
				  }
			?>
			</div>
		</div>
	</div>