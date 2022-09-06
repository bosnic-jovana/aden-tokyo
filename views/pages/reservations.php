<?php
    if(!isset($_SESSION["user"])){
        header("Location: 403.php");
    }
?>
<div id="featured-hotel" class="fh5co-bg-color">
	<div class="container">
		<div class="row">
			<div class="accommodations col-lg-12">
                <table class="table">
                    <tr>
                        <th>Room name</th>
                        <th>Accommodation type</th>
                        <th>Guests number</th>
                        <th>Check in</th>
                        <th>Check out</th>
                        <th>Price</th>   
                        <th>Cancel reservation</th>              
                    </tr>
				<?php
                    $id = $_SESSION["user"]->id_user;
					$reservations = getReservations($id);
                    if(count($reservations) > 0):
                        foreach($reservations as $res):
                            $chkIn = explode("-", $res->check_in);
                            $chkOut = explode("-", $res->check_out);
                            $chkInTime = mktime(0, 0, 0, $chkIn[1], $chkIn[2], $chkIn[0]);
                            $chkOutTime = mktime(0, 0, 0, $chkOut[1], $chkOut[2], $chkOut[0]);
                            $days = floor(($chkOutTime - $chkInTime)/60/60/24);
                            
                ?>
                        <tr>
                            <td><?= $res->room_name ?></td>
                            <td><?= $res->name_type ?></td>
                            <td><?= $res->number_ppl ?></td>
                            <td><?= $res->check_in ?></td>
                            <td><?= $res->check_out ?></td>
                            <td><?= $res->price * $days ?> &yen;</td>
                            <?php
                                $today = mktime();
                                if($chkInTime > $today){
                                    echo "<td><a href='models/reservations/cancel.php?id=$res->id_reservation'>Cancel</a></td>";
                                }
                                else{
                                    echo "<td></td>";
                                }
                            ?>
                        </tr>
                <?php
                        endforeach;
                    endif;
                ?>
                </table>
			</div>
		</div>
	</div>
</div>
