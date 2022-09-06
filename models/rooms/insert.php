<?php
    session_start();
    header("Content-type: applicaton/json");
    if(isset($_SESSION["user"])){
        if($_SESSION["user"]->id_role == 1){
                include "../../config/connection.php";
                include "../functions.php";
        
                try{
                   $konekcija->beginTransaction();

                    $nameRoom = $_POST['nameRoom'];
                    $album = $_POST['album'];
                    $description = $_POST['description'];
                    $priceBr2 = $_POST['priceBr2'];
                    $priceBr3 = $_POST['priceBr3'];
                    $priceRfr2 = $_POST['priceRfr2'];
                    $priceRfr3 = $_POST['priceRfr3'];
                
                     $errors = [];

                    $colRoom = "room_name, description, album";
                    $valRoom = [$nameRoom, $description, $album];
                    insert("rooms", $colRoom, $valRoom);
                    $idRoom = $konekcija->lastInsertId();
                    
                    $colType = "id_room, id_acc_type";
                    insert("room_type", $colType, [$idRoom, 1]);
                    $idBr = $konekcija->lastInsertId();

                    insert("room_type", $colType, [$idRoom, 2]);
                    $idRfr = $konekcija->lastInsertId();

                    $colPrice = "number_ppl, id_room_type, price";
                    insert("price", $colPrice, [2, $idBr, $priceBr2]);
                    insert("price", $colPrice, [2, $idRfr, $priceRfr2]);
                    insert("price", $colPrice, [3, $idBr, $priceBr3]);
                    insert("price", $colPrice, [3, $idRfr, $priceRfr3]);
                    
                    if(isset($_FILES['photo'])){
                        $photo = $_FILES['photo'];
                        $photoType = $photo["type"];
                        $photoTmp = $photo["tmp_name"];
                        $photoName = $photo["name"];
                        $types = ["image/jpg", "image/jpeg", "image/png"];

                        if(!in_array($photoType, $types)){
                            array_push($errors, "File must have .jpg/.jpeg/.png extension.");
                        }
                        if($photo["size"] > (5 * 1024)){
                            array_push($errors, "The maximum file size is 500KB.");
                        }

                        if(count($errors) == 0){
                            $newName = time()."_".$photoName;
                            
                            $newPath = "../../assets/images/".$newName;

                            if(move_uploaded_file($photoTmp, $newPath)){
                                $alt = $nameRoom." Cover";
                                $colPicture = "src, alt, id_room";
                                insert("room_pic", $colPicture, [$newName, $alt, $idRoom]);
                            }

                            $uploadedPic = null;
                            switch($photoType){
                                case 'image/jpeg':
                                    $uploadedPic = imagecreatefromjpeg($photoTmp);
                                    break;
                                case 'image/png':
                                    $uploadedPic = imagecreatefrompng($photoTmp);
                                    break;
                            }

                            list($width, $height) = getimagesize($photoTmp);
                            $newWidth = 200;
                            $newHeight = $height * $newWidth / $width;
                            
                            $newPic = imagecreatetruecolor($newWidth, $newHeight);
                            imagecopyresampled($newPic, $uploadedPic, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

                            $thumbPic = "thumb_". $newName;
                            $pathThumbPic = "assets/images/".$thumbPic;

                            switch($photoType){
                                case 'image/jpeg':
                                    imagejpeg($newPic, "../../".$pathThumbPic);
                                    break;
                                case 'image/png':
                                    imagepng($newPic, "../../".$pathThumbPic);
                                    break;
                            }

                            imagedestroy($uploadedPic);
                            imagedestroy($newPic);
                        }
                    }

                    $konekcija->commit();
                    $response = ["message" => "Successfully inserted."];
                    echo json_encode($response);
                }
                catch(PDOException $exce){
                    $konekcija->rollback();
                    http_response_code(500);
                }
        }
        else{
            header("Location: ../../403.php");
        }
    }
    else{
        header("Location: ../../403.php");
    }
?>