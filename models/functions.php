<?php
function vratiSve($tabela){
    global $konekcija;
    $upit = "SELECT * FROM $tabela";
    $dobijeniPodaci = $konekcija->query($upit)->fetchAll();
    return $dobijeniPodaci;
}
function pojedinacnaSoba($id){
    global $konekcija;
    $upit = "SELECT * FROM rooms WHERE id_room = :id";
    $priprema = $konekcija->prepare($upit);
    $priprema->bindParam(":id", $id);
    $priprema->execute();
    $rezultat = $priprema->fetch();
    return $rezultat;
}
function roomPictures($id){
    global $konekcija;
    $upit = "SELECT rp.src, rp.alt FROM rooms r INNER JOIN room_pic rp
                ON r.id_room = rp.id_room
                WHERE r.id_room = ?";
    $priprema = $konekcija->prepare($upit);
    $priprema->execute([$id]);
    $dobijeniPodaci = $priprema->fetchAll();
    return $dobijeniPodaci;
}
function price($id, $number, $type){
    global $konekcija;
    $upit = "SELECT p.id_price, p.price FROM rooms r INNER JOIN room_type rt
    ON r.id_room = rt.id_room INNER JOIN accommodation_type acct
    ON acct.id_acc_type=rt.id_acc_type INNER JOIN price p
    ON rt.id_room_type=p.id_room_type
    WHERE r.id_room = ? AND p.number_ppl = ? AND acct.id_acc_type= ?
    ORDER BY p.date desc 
    LIMIT 1";
    $priprema = $konekcija->prepare($upit);
    $priprema->execute([$id, $number, $type]);
    $dobijeniPodaci = $priprema->fetch();
    return $dobijeniPodaci;
}
function tipICenaZaSobu($id){
    global $konekcija;
    $upit = "SELECT p.id_room_type, acct.name_type, p.id_price, p.number_ppl, p.price
    FROM rooms r INNER JOIN room_type rt
    ON r.id_room = rt.id_room INNER JOIN accommodation_type acct
    ON acct.id_acc_type=rt.id_acc_type INNER JOIN price p
    ON rt.id_room_type=p.id_room_type
    WHERE r.id_room = $id";
    $dobijeniPodaci = $konekcija->query($upit)->fetchAll();
    return $dobijeniPodaci;
}
function tipSlikaCenaZaSveSobe(){
    global $konekcija;
    $upit = "SELECT r.id_room, r.room_name, r.album, r.description, r.album, rp.src, rp.alt, acct.name_type, p.number_ppl, p.price
    FROM rooms r INNER JOIN room_pic rp ON r.id_room = rp.id_room
    INNER JOIN room_type rt ON r.id_room = rt.id_room 
    INNER JOIN accommodation_type acct ON acct.id_acc_type=rt.id_acc_type 
    INNER JOIN price p ON rt.id_room_type=p.id_room_type
    GROUP BY r.room_name, acct.name_type, p.number_ppl
    HAVING MIN(rp.id_room_pic)";
    $dobijeniPodaci = $konekcija->query($upit)->fetchAll();
    return $dobijeniPodaci;
}
function filterSortSobe($roomCat, $guestsNum, $accType, $sortPrice){
    global $konekcija;
    $upit = "SELECT r.id_room, r.room_name, r.album, r.description, r.album, rp.src, rp.alt, acct.name_type, p.number_ppl, p.price
        FROM rooms r INNER JOIN room_pic rp ON r.id_room = rp.id_room
        INNER JOIN room_type rt ON r.id_room = rt.id_room 
        INNER JOIN accommodation_type acct ON acct.id_acc_type=rt.id_acc_type 
        INNER JOIN price p ON rt.id_room_type=p.id_room_type ";

    if($roomCat != null){
        $upit .= "WHERE r.id_room = $roomCat ";
        if($guestsNum != null){
            $upit .= "AND p.number_ppl = $guestsNum ";
        }
        if($accType != null){
            $upit .= "AND acct.id_acc_type = $accType ";
        }
    }
    else if($guestsNum != null){
        $upit .= "WHERE p.number_ppl = $guestsNum ";
        if($accType != null){
            $upit .= "AND acct.id_acc_type = $accType ";
        }
    }
    else if($accType != null){
        $upit .= "WHERE acct.id_acc_type = $accType ";
    }
   
    $upit .= "GROUP BY r.room_name, acct.name_type, p.number_ppl
        HAVING MIN(rp.id_room_pic) ";

     if($sortPrice != null){
        $upit .= "ORDER BY p.price $sortPrice";
    }

    $dobijeniPodaci = $konekcija->query($upit)->fetchAll();
    return $dobijeniPodaci;

}
function tipovi($id){
    global $konekcija;
    $upit = "SELECT DISTINCT acct.id_acc_type, acct.name_type
    FROM rooms r INNER JOIN room_type rt
    ON r.id_room = rt.id_room INNER JOIN accommodation_type acct
    ON acct.id_acc_type=rt.id_acc_type
    WHERE r.id_room = $id";
    $dobijeniPodaci = $konekcija->query($upit)->fetchAll();
    return $dobijeniPodaci;
}
function logovanje($email, $pass){
    global $konekcija;
    $upit = "SELECT * FROM users u INNER JOIN role r
            ON u.id_role=r.id_role
            WHERE u.email = :email AND u.password = :password";
    $priprema = $konekcija->prepare($upit);
    $priprema->bindParam(":email", $email);
    $priprema->bindParam(":password", $pass);
    $priprema->execute();
    $rezultat = $priprema->fetch();
    return $rezultat;
}
function succOrErrLogFile($email, $message, $error = false){
    
    if($error){
        $open = fopen(ERROR_LOG, "a+");
    }
    else{
        $open = fopen(SUCCESS_LOG, "a+");
    }

    if($open){
        $date = date("d-m-Y");
        $time = date("H:i:s");
        fwrite($open, "{$_SERVER['REMOTE_ADDR']}".SEPARATOR."{$email}".SEPARATOR."{$date}".SEPARATOR."{$time}".SEPARATOR."{$message}\n");
        fclose($open);
    }
}
function emailWarning($email){
    global $konekcija;
    $upit = "SELECT * FROM users WHERE email = :email";
    $priprema = $konekcija->prepare($upit);
    $priprema->bindParam(":email", $email);
    $priprema->execute();
    $rezultat = $priprema->fetch();
    if(count($rezultat)){
        $podaci = file(ERROR_FILE);
        $now = mktime();
        foreach($podaci as $podatak){
            $niz = explode(SEPARATOR, $podatak);
            if($email == $niz[1]){
                $dateLog = explode("-", $niz[2]);
                $timeLog = explode(":", $niz[3]);
                $timestamp = mktime($timeLog[0], $timeLog[1], $timeLog[2], $dateLog[1], $dateLog[0], $dateLog[2]);
                $razlikaMinuti = ($now - $timestamp) / 60;
                if($razlikaMinuti < 5){
                    $br++;
                }
            }
        }
        if($br == 3){
            mail($email, "Warning - Aden Hotel Account" , "Hello, someone is trying to access your account with incorrect parameters.");
        }
    }
}
function getReservations($idUser){
    global $konekcija;
    $upit = "SELECT *
    FROM rooms r INNER JOIN room_type rt ON r.id_room = rt.id_room 
    INNER JOIN accommodation_type acct ON acct.id_acc_type=rt.id_acc_type 
    INNER JOIN price p ON rt.id_room_type=p.id_room_type
    INNER JOIN reservation res ON res.id_price=p.id_price
    INNER JOIN users u ON res.id_user=u.id_user
    WHERE u.id_user = ?";;
    $priprema = $konekcija->prepare($upit);
    $priprema->execute([$idUser]);
    $dobijeniPodaci = $priprema->fetchAll();
    return $dobijeniPodaci;
}
function cancelReservation($id){
    global $konekcija;
    $upit = "DELETE FROM reservation WHERE id_reservation = :id";
    $priprema = $konekcija->prepare($upit);
    $priprema->bindParam(":id", $id);
    $rezultat = $priprema->execute();
    return $rezultat;
}
function deleteRoom($id){
    global $konekcija;
    $upit = "DELETE FROM rooms WHERE id_room = :id";
    $priprema = $konekcija->prepare($upit);
    $priprema->bindParam(":id", $id);
    $rezultat = $priprema->execute();
    return $rezultat;
}
function updateRoom($idRoom, $nameRoom, $album, $description){
    global $konekcija;
    $upit = "UPDATE rooms 
            SET room_name=:nameRoom, album=:album, description=:description
            WHERE id_room=:id";
    $priprema = $konekcija->prepare($upit);
    $priprema->bindParam(":id", $idRoom);
    $priprema->bindParam(":nameRoom", $nameRoom);
    $priprema->bindParam(":album", $album);
    $priprema->bindParam(":description", $description);
    $rezultat = $priprema->execute();
    return $rezultat;
}
function insert($table, $columnsNames, $columnsValues){
    global $konekcija;
    $val = "?";
    for($i = 1; $i < count($columnsValues); $i++){
        $val .= ", ?";
    }
    $query = "INSERT INTO $table ($columnsNames) VALUES($val)";
    $prep = $konekcija->prepare($query);
    $result = $prep->execute($columnsValues);
    return $result;
}
function topMessages($limit = 0){
    global $konekcija;
    $offset = 2;
    $upit = "SELECT *
            FROM users_messages um INNER JOIN users u
            ON um.id_user=u.id_user
            WHERE um.show_on_page = 1
            LIMIT :limit, :offset";
     $priprema = $konekcija->prepare($upit);
     $priprema->bindParam(":limit", $limit, PDO::PARAM_INT);
     $priprema->bindParam(":offset", $offset, PDO::PARAM_INT);
     $priprema->execute();
     $rezultat = $priprema->fetchAll();
     return $rezultat;
}
function messagesAndUsers(){
    global $konekcija;
    $upit = "SELECT u.first_name, u.last_name, um.id_message, um.message, um.show_on_page
            FROM users u INNER JOIN users_messages um
            ON u.id_user=um.id_user";
    $dobijeniPodaci = $konekcija->query($upit)->fetchAll();
    return $dobijeniPodaci;
}
function updateVisibilityMessages($id, $visibility){
    global $konekcija;
    $upit = "UPDATE users_messages
            SET show_on_page = :visibility
            WHERE id_message = :id";
    $priprema = $konekcija->prepare($upit);
    $priprema->bindParam(":id", $id, PDO::PARAM_INT);
    $priprema->bindParam(":visibility", $visibility, PDO::PARAM_INT);
    $rezultat = $priprema->execute();
    return $rezultat;
}

?>