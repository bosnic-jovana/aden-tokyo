<div id="featured-hotel" class="fh5co-bg-color">
		<div class="container">
			<div class="row">
				<h2>Select Filters</h2>
                <div id="availability">
				<form action="#">
					<div class="a-col">
							<section>
								<select id="roomCat" name="roomCat" class="cs-select cs-skin-border">
									<option value="0" disabled selected>Room Category</option>
									<?php
										foreach($sobe as $soba):
									?>
										<option value="<?= $soba->id_room ?>"><?= $soba->room_name ?></option>
									<?php
										endforeach;
									?>
								</select>
							</section>
						</div>
						<div class="a-col">
							<section>
								<select id="guestsNum" name="guestsNum" class="cs-select cs-skin-border">
									<option value="" disabled selected>Guests Number</option>
									<option value="2">Two</option>
									<option value="3">Three</option>
								</select>
							</section>
						</div>
                        <div class="a-col">
							<section>
								<select id="accType" name="accType" class="cs-select cs-skin-border">
									<option value="0" disabled selected>Accommodation Type</option>
									<?php
										$tipovi = vratiSve("accommodation_type");
										foreach($tipovi as $tip):
									?>
										<option value="<?= $tip->id_acc_type ?>"><?= $tip->name_type ?></option>
									<?php
										endforeach;
									?>
								</select>
							</section>
						</div>
						<div class="a-col">
							<section>
								<select id="sortPrice" name="sortPrice" class="cs-select cs-skin-border">
									<option value="0" disabled selected>Sort By</option>
                                    <option value="asc" >Lowest Price</option>
                                    <option value="desc">Highest Price</option>
								</select>
							</section>
						</div>
						<div class="a-col action">
							<a id="roomsFilters"  href="#">
								<span>Use</span>
								Filters
							</a>
						</div>
				</form>
                </div>
			</div>
			<div class="row">
				<div class="col-lg-12 accommodations">
				<?php
					$sobe = tipSlikaCenaZaSveSobe();
					$imenaSoba = [];
					foreach($sobe as $soba){
						if(!in_array($soba->room_name, $imenaSoba)){
							array_push($imenaSoba, $soba->room_name);
						}
					}
					
					foreach($imenaSoba as $imeSobe){
						foreach($sobe as $soba){
							if($soba->room_name == $imeSobe){
								echo "<div class='row'><div class='col-lg-5'>
								<img width='100%' src='assets/images/$soba->album/$soba->src' alt='$soba->alt'></div>
								<div class='col-lg-7'><h2>$imeSobe</h2>
								<p>$soba->description</p></div></div><hr>";
								break;
							}
						}
						foreach($sobe as $soba){
							if($soba->room_name == $imeSobe){
								echo "<div class='row'>
								<div class='col-lg-4'><p>$soba->name_type</p></div>
								<div class='col-lg-3'><p>$soba->number_ppl Gusets</p></div>
								<div class='col-lg-3'><p>$soba->price &yen;</p></div>
								<div class='col-lg-2'><a href='index.php?page=accommodation&idRoom=$soba->id_room' class='btn btn-primary btn-luxe-primary'>Book Now</a></div>
								</div>
								<hr>";
							}
						}
					}
				?>
				</div>
			</div>
		</div>
	</div>
