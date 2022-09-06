<div id="fh5co-wrapper">
        <div id="fh5co-page">
            <div id="fh5co-header">
                <header id="fh5co-header-section">
                    <div class="container">
                        <div class="nav-header">
                            <a href="#" class="js-fh5co-nav-toggle fh5co-nav-toggle"><i></i></a>
                            <h1 id="fh5co-logo">
                                <a href="index.php">
                                    <span>Aden Tokyo</span>
                                </a>
                            </h1>
                            <nav id="fh5co-menu-wrap" role="navigation">
                                <ul class="sf-menu" id="fh5co-primary-menu">
                                <?php
                                    
                                    $meni = vratiSve("menu");
                                    $sobe = vratiSve("rooms");
                                    if(isset($_GET["page"])){
                                        $page = $_GET["page"];
                                    }
                                    $ispis = "";
                                       
                                    foreach($meni as $m){
                                            if($m->href != "admin"){
                                                if($m->href == "accommodation"){
                                                    $ispis .= "<li><a href='index.php?page=accommodations' class='fh5co-sub-ddown'>$m->text</a>
                                                                <ul class='fh5co-sub-menu'>";
                                                    foreach($sobe as $s){
                                                        $ispis .= "<li><a href='index.php?page=$m->href&idRoom=$s->id_room'>$s->room_name</a></li>";
                                                    }
                                                    $ispis .= "<li><a href='index.php?page=accommodations'>All accommodations</a></li>";
                                                    $ispis .= "</ul></li>";
                                                }
                                                else if($m->href == "login" && isset($_SESSION["user"])){
                                                    $ispis .= "<li><a href='index.php?page=reservations'>My reservations</a></li>";
                                                    $ispis .= "<li><a href='models/users/logout.php' class='btn btn-primary'>{$_SESSION['user']->first_name} - Log out</a></li>";
                                                }
                                                else if(strpos($page, $m->href)){
                                                    $ispis .= "<li><a class='active' href='index.php?page=$m->href'>$m->text</a></li>";
                                                }
                                                else{
                                                    $ispis .= "<li><a href='index.php?page=$m->href'>$m->text</a></li>";
                                                }
                                            }
                                            else{
                                                if(isset($_SESSION["user"])){
                                                    if($_SESSION["user"]->id_role == 1){
                                                        if(strpos($page, $m->href)){
                                                            $ispis .= "<li><a class='active' href='index.php?page=$m->href'>$m->text</a></li>";
                                                        }else{
                                                            $ispis .= "<li><a href='index.php?page=$m->href'>$m->text</a></li>";
                                                        }
                                                    }
                                                } 
                                            }
                                    }
                                    echo $ispis;
                                ?>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </header>
            </div>