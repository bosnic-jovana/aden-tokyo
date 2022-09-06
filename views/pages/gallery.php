
	<div id="fh5co-blog-section">
		<div class="container-gall">
			<div class="gallery">
				<?php
					$gallery = vratiSve("gallery");
					$ispis = "";

					foreach($gallery as $picture){
						$ispis .= '<a href="assets/'.$picture->href.'" data-lightbox="gallery" class="img-grid-'.$picture->id_gallery.'"></a>';
					}
					echo($ispis);
				?>
			</div>
		</div>
	</div>
