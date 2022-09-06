
	<div id="featured-hotel" class="fh5co-bg-color">
		<div class="containerImg">
			<div class="row">
				<div class="col-md-12">
					<div class="section-title text-center">
						<?php
							if(isset($_GET["idRoom"])){
								$id = $_GET["idRoom"];
								$soba = pojedinacnaSoba($id);
								echo '<h2>'.$soba->room_name.'</h2>';
							}
						?>
					</div> 
					<div class="container">
						<p>Aden Tokyo’s Rooms and Suites are lofty urban accommodations drawing design inspiration from traditional Japanese residences.
							<br/>Blending wood, washi paper and stone with modern technology and luxurious fabrics, they offer magnificent views including the <i>Imperial Palace Gardens</i> and <i>Mt Fuji</i> on the horizon on clearer days.</p>
					</div>
				</div>
			</div>

			<div class="container containerImg">
			<?php
					$slike = roomPictures($id);
					$putanjaFolder = $soba->album;
					$ispis = "";

					foreach($slike as $slika){
						$ispis .= '<div class="mySlides">
									<img src="assets/images/'.$putanjaFolder.'/'.$slika->src.'" alt="'.$slika->alt.'" style="width:100%">
								</div>';
					}

					$ispis .= '<a class="prev">❮</a><a class="next">❯</a>
								<div class="row rowImg">';
					$i = 1;
					foreach($slike as $sl){
						$ispis .= '<div class="column">
						<img class="demo cursor" src="assets/images/'.$putanjaFolder.'/'.$sl->src.'" alt="'.$sl->alt.'" style="width:100%" data-id="'.$i.'">
						</div>';
						$i++;
					}
					$ispis .= '</div>';
					echo $ispis;
			?>
			</div>
			<div class="container-fluid bgWhite">
				<div class="container">
					<div class="description my-auto">
						<p>
							<?php
								echo $soba->description;
							?>
						</p>
					</div><hr/>
					<div class="row">
						<div class="col-lg-6">
							<h3>Breakfast in Tokyo</h3>
							<p class="orange">The stay includes</p>
							<ul>
								<li>Daily breakfast at The Restaurant for up to two people.</li>
							</ul><br/>
							<div class="row">
								<div class="col-lg-6">
									<h4>Two guests/night</h4>
									<p>
										<?php
											$price = price($id, 2, 1);
											echo($price->price);
										?>
										&yen;
									</p>
								</div>
								<div class="col-lg-6">
									<h4>Three guests/night</h4>
									<p>
										<?php
											$price = price($id, 3, 1);
											echo($price->price);
										?>
										&yen;
									</p>
								</div>
							</div>
						</div>
						<div class="col-lg-6">
							<h3>Retreat for Recovery</h3>
							<p class="orange">The stay includes</p>
							<ul>
								<li>Daily breakfast at The Resturant per person.</li>
								<li>One 120 min Tea Journey spa treatment.</li>
							</ul>
							<div class="row">
								<div class="col-lg-6">
									<h4>Two guests/night</h4>
									<p>
										<?php
											$price = price($id, 2, 2);
											echo($price->price);
										?>
										&yen;
									</p>
								</div>
								<div class="col-lg-6">
									<h4>Three guests/night</h4>
									<p>
										<?php
											$price = price($id, 3, 2);
											echo($price->price);
										?>
										&yen;
									</p>
								</div>
							</div>
						</div>
					</div><hr/>
					<div class="row">
						<h2>Reservation</h2>
						<div id="availability">
							<form action="#">
								<div class="a-col">
									<section>
										<select id="tipSobe" name="tipSobe" class="cs-select cs-skin-border">
											<option value="0" disabled selected>Select Type</option>
											<?php
												$ispis = "";
												$nizTipova = tipovi($id);
												foreach($nizTipova as $tip){
												$ispis .= "<option value='$tip->id_acc_type'>$tip->name_type</option>";
											}
											echo($ispis);
											?>
										</select>
									</section>
								</div>
								<div class="a-col">
									<section>
										<select id="brojOsoba" name="brojOsoba" class="cs-select cs-skin-border">
											<option value="" disabled selected>Select Number</option>
											<option value="2">Two</option>
											<option value="3">Three</option>
										</select>
									</section>
								</div>
								<div class="a-col alternate">
									<div class="input-field">
										<label for="date-start">Check In</label>
										<input type="text" class="form-control" id="date-start" name="datumOd" />
									</div>
								</div>
								<div class="a-col alternate">
									<div class="input-field">
										<label for="date-end">Check Out</label>
										<input type="text" class="form-control" id="date-end" name="datumDo" />
									</div>
								</div>
								<div class="a-col action">
									<a id="reserve" data-idsobe="<?= $id ?>" href="#">
										<span>Make a</span>
										Reservation
									</a>
								</div>
							</form>
						</div>
						<div class="row">
							<br/>
							<div class="col-lg-12" id="responseReserv">
							
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	