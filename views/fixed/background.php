<div class="fh5co-parallax" data-stellar-background-ratio="0.5">
	<div class="overlay"></div>
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-md-offset-0 col-sm-12 col-sm-offset-0 col-xs-12 col-xs-offset-0 text-center fh5co-table">
				<div class="fh5co-intro fh5co-table-cell">
					<h1 class="text-center">
                        <?php 
							 if(isset($_GET["page"])){
								$page = $_GET["page"];

								foreach($meni as $m){
									if($page == $m->href){
										echo $m->text;
									}
									if($page == "accommodations"){
										echo "All accommodations";
										break;
									}
									if($page == "reservations"){
										echo "My reservations";
										break;
									}
								}
							}
                        ?>
                    </h1>
				</div>
			</div>
		</div>
	</div>
</div>