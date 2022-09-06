            <footer id="footer" class="fh5co-bg-color">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3>Company</h3>
                                    <ul class="link">
                                        <?php
                                            foreach($meni as $m){
                                                if($m->href != "admin"){
                                                    echo "<li><a href='index.php?page=$m->href'>$m->text</a></li>";
                                                }
                                            }
                                        ?>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <h3>Our Facilities</h3>
                                    <ul class="link">
                                        <?php
                                            $facilities = vratiSve("facilities");
                                            foreach($facilities as $fac){
                                                echo "<li><a href='#'>$fac->name</a></li>";
                                            }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <ul class="social-icons">
                                <li>
                                    <a href="https://twitter.com/"><i class="icon-twitter-with-circle"></i></a>
                                    <a href="https://www.facebook.com/"><i class="icon-facebook-with-circle"></i></a>
                                    <a href="https://www.instagram.com/"><i class="icon-instagram-with-circle"></i></a>
                                    <a href="https://www.linkedin.com/"><i class="icon-linkedin-with-circle"></i></a>
                                </li>
                            </ul>
                            <ul class="link"> 
                                <li><a href='data/documentation.pdf'>Documentation</a></li>
                                <li><a href='index.php?page=author'>Author</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
	        </footer>
	    </div>
    </div>
    
        <script src="assets/js/lightbox-plus-jquery.min.js"></script>
        <script src="assets/js/jquery-2.1.4.min.js"></script>
        <script src="assets/js/hoverIntent.js"></script>
        <script src="assets/js/superfish.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.waypoints.min.js"></script>
        <script src="assets/js/jquery.countTo.js"></script>
        <script src="assets/js/jquery.stellar.min.js"></script>
        <script src="assets/js/bootstrap-datepicker.min.js"></script>
        <script src="assets/js/classie.js"></script>
        <script src="assets/js/selectFx.js"></script>
        <script src="assets/js/jquery.flexslider-min.js"></script>
        <script src="assets/js/custom.js"></script>
        <script src="assets/js/main.js"></script>
    </body>
</html>