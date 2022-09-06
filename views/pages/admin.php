<div id="fh5co-contact-section" class="container">
		<div class="row">
            <div class="col-md-12">
				<div class="section-title text-center">
					<h2>Rooms - <a href="models/rooms/export.php">Export rooms in excel format</a> </h2>
				</div>
			</div>
		    <div class="col-md-12 tableAdmin">
				<table class="table">
                    <tr>
                        <th>Room id</th>
                        <th>Room name</th>
                        <th>Description</th>
                        <th>Album</th>
                        <th>Update</th>
                        <th>Delete</th>                      
                    </tr>
                    <?php
                        $ispis ="";
                        foreach($sobe as $soba){
                            $ispis .= "
                            <tr>
                                <td>$soba->id_room</td>
                                <td id='room$soba->id_room'>$soba->room_name</td>
                                <td id='description$soba->id_room'>$soba->description</td>
                                <td id='album$soba->id_room'>$soba->album</td>
                                <td><a class='roomUpdate' href='#roomsInsertUpdateH' data-id='$soba->id_room'>Update</a></td>
                                <td><a class='roomDelete' href='models/rooms/delete.php?id=$soba->id_room'>Delete</a></td>
                            </tr>";
                        }
                        echo $ispis;
                    ?>
                </table>
			</div>
			<div class="col-md-12">
				<div class="section-title text-center">
					<h2 id="roomsInsertUpdateH">Insert or update room</h2>
				</div>
			</div>
            <div class="col-md-12 tableAdmin">
                <form action="#">
                    <div class="col-md-6">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" id="nameRoom" name="nameRoom" class="form-control" placeholder="Room name">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" id="album" name="album" class="form-control" placeholder="Album">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <textarea id="description" name="description" rows="4" class="form-control" placeholder="Description"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="coverPhoto">Choose cover photo of room</label>
                                <div id="files">
                                    <input type="file" class="photos" name="files[]" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="number" id="priceBr2" name="priceBr2" class="form-control" placeholder="Breakfast in Tokyio 2 Guests - Price">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="number" id="priceBr3" name="priceBr3" class="form-control" placeholder="Breakfast in Tokyio 3 Guests - Price">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="number" id="priceRfr2" name="priceRfr2" class="form-control" placeholder="Retreat for Recovery 2 Guests - Price">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="number" id="priceRfr3" name="priceRfr3" class="form-control" placeholder="Retreat for Recovery 3 Guests - Price">
                            </div>
                        </div>
                        <div id="errorInsertUpdate" class="col-md-12"></div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="button" value="Insert" id="insertUpdate" class="btn btn-primary">
                            </div>
                        </div>
                    </div>         
                </form>
            </div>
            <div class="col-md-12">
                <div class="section-title text-center">
                    <h2>Messages and recensions from users.</h2>
                </div>
			</div>
            <div class="col-md-12 tableAdmin">
                    <table class="table">
                        <tr>
                            <th>First and last name</th>
                            <th>Message</th>
                            <th>Visibility on page</th>                     
                        </tr>
                        <?php
                            $ispis ="";
                            $poruke = messagesAndUsers();
                            foreach($poruke as $poruka){
                                $ispis .= "<tr>
                                    <td>$poruka->first_name $poruka->last_name</td>
                                    <td>$poruka->message</td>";
                                if($poruka->show_on_page == 1){
                                    $ispis .= "<td><a href='models/messages/updateVisibility.php?id=$poruka->id_message&visibility=0'>Hide</a></td>";
                                }
                                else{
                                    $ispis .= "<td><a href='models/messages/updateVisibility.php?id=$poruka->id_message&visibility=1'>Show</a></td>";
                                }
                                    $ispis .= "</tr>";
                            }
                            echo $ispis;
                        ?>
                    </table>
            </div>
            <div class="col-md-12">
				<div class="section-title text-center">
					<h2>Site access statistics in the last 24 hours</h2>
				</div>
			</div>
            <div class="col-md-12 tableAdmin">
                    <table class="table">
                        <tr>
                            <th>Page</th>
                            <th>Attendance in the last 24 hours as a percentage</th>                     
                        </tr>
                        <?php
                            $ispis ="";
                            $podaci = file(LOG_FILE);
                            $menu = vratiSve("menu");
                            $date = date("d-m-Y");
                            $rezultat = [];
                            $br = 0;
                            $ukupno = 0;
                            foreach($menu as $m){
                                foreach($podaci as $podatak){
                                    $niz = explode(SEPARATOR, $podatak);
                                    $dateLog = explode(" ", $niz[3]);
                                    $pageLog = explode("=", $niz[1]);
                                    @ $pageLog = explode("&", $pageLog[1]);

                                    if($date == $dateLog[0] && $m->href == @$pageLog[0]){
                                        $br++;
                                        $ukupno++;
                                    }
                                }
                                array_push($rezultat, $br);
                                $br = 0;
                            }
                            $i=0;
                            foreach($menu as $m){
                                $ispis .= "<tr>
                                            <td>$m->text</td>
                                            <td>". round($rezultat[$i]/$ukupno * 100, 2) ."%</td>
                                        </tr>";
                                $i++;
                            }
                            echo $ispis;
                        ?>
                    </table>
            </div>
            <div class="col-md-12">
				<div class="section-title text-center">
                <?php
                    $file = file(SUCCESS_LOG);
                    $date = date("d-m-Y");
                    $users = [];
                    foreach($file as $row){
                        $arr = explode(SEPARATOR, $row);
                        if($date == $arr[2]){
                            if(!in_array($arr[1], $users)){
                                array_push($users, $arr[1]);
                            }
                        }
                    }
                ?>
					<h2>The number of different successfully logged in users for <?= $date ?> is <?= count($users) ?></h2>
				</div>
			</div>
		</div>
	</div>
