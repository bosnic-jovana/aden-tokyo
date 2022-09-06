$(document).ready(function(){

    $("#registerBtn").click(registerUser);
    $("#reserve").click(reserveRoom);
    $(".roomUpdate").click(updateRoom);
    $("#insertUpdate").click(updateInsertRoom);
    $("#roomsFilters").click(filterSortRooms);
    $("#message").click(userMessage);
    $(".komentari").click(showComments);

    var lokacija = location.search;
    
    
    var slideIndex = 1;
    if(lokacija.indexOf("accommodation") != -1 && lokacija.indexOf("s") == -1){
        showSlides(slideIndex);
    }
    $(".prev").on("click", function(){
        showSlides(slideIndex -= 1);
    });
    $(".next").on("click", function(){
        showSlides(slideIndex += 1);
    });
    $(".demo").click(currentSlide);

    function currentSlide() {
        let n = $(this).data("id");
        showSlides(slideIndex = n);
    }

    function showSlides(n) {
        var i;
        var slides = document.getElementsByClassName("mySlides");
        var dots = document.getElementsByClassName("demo");

        if (n > slides.length) {slideIndex = 1}
        if (n < 1) {slideIndex = slides.length}
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
        }
        slides[slideIndex-1].style.display = "block";
        dots[slideIndex-1].className += " active";
    }

    $("#files").on("change", "input", function(event){
        $('#files').append('<input type="file" class="photos" name="files[]" class="form-control">')
    });
    
    var reEmail = /^[\w\.\-]+\@([a-z\d]+\.)+[a-z]{2,3}$/;
    var rePass = /^.{5,40}$/;
    var errEmail = "Email must contain @, and it could only use lowercase letters, numbers, '.' and '-'.";
    var errPass = "Password must contain at least 5 character.";

function registerUser(e){

    e.preventDefault();

    let firstName = $("#firstName");
    let lastName = $("#lastName");
    let email = $("#email");
    let phone = $("#phone");
    let password = $("#pass"); 
    let confPass = $("#confPass");

    let reNameLast = /^[A-ZŠĐŽČĆ][a-zšđžčć]{2,14}(\s[A-ZŠĐŽČĆ][a-zšđžčć]{2,14})?$/; 
    let rePhone = /^(\+381\s|0)6[0-69]\s[0-9]{3}\s[0-9]{3,4}$/;

    let errName = "Please enter name with capital letter and at least 3 character.";
    let errLastname = "Please enter lastname with capital letter and at least 3 character.";
    let errPhone = "Correct format for phone number is +381 6x yyy yyy(y) or 06x yyy yyy(y)";
    let errPassConf = "Please enter same password.";

    var errors = 0;

    provera(firstName, reNameLast, errName);
    provera(lastName, reNameLast, errLastname);
    provera(email, reEmail, errEmail);
    provera(phone, rePhone, errPhone);
    provera(password, rePass, errPass);

    function provera(field, regEx, message){
        if(!regEx.test(field.val())){
            errors++;
            field.css("border-color", "#FF5722");
            field.next().html(message);
        }
        else{
            field.css("border-color", "#58a6a6");
            field.next().html("");
        }
    }

    if(password.val() != confPass.val() || confPass.val() == ""){
        errors++;
        confPass.css("border-color", "#FF5722");
        confPass.next().html(errPassConf);
    }
    else{
        confPass.css("border-color", "#58a6a6");
        confPass.next().html("");
    }
    
    if(errors == 0){
        $.ajax({
            url : "models/users/register.php",
            method : "POST",
            dataType : "json",
            data : {
                firstName : firstName.val(),
                lastName : lastName.val(),
                email : email.val(),
                phone : phone.val(),
                password : password.val()
            },
            success : function(result){
                $("#regResult").html(`<p class="alert alert-success">${result.message}</p>`);
                $("#email").css("border-color", "#58a6a6");
            },
            error : function(xhr){
                if(xhr.status == 500){
                    $("#regResult").html(`<p class="alert alert-danger">This email is already used. Try to 
                    register with another one.</p>`);
                    $("#email").css("border-color", "#FF5722");
                }
            }
        });
    }
}
function showComments(e){
    e.preventDefault();
    let limit = $(this).data("limit");
    $.ajax({
        url : "models/messages/showHomePageComm.php",
        method : "POST",
        dataType : "json",
        data : {
            limit : limit,
        },
        success : function(result){
            let ispis = "";
            for(let res of result){
                ispis += `<div class='col-md-6'>
						<div class='testimony'>
							<blockquote>
								&ldquo;${res.message}&rdquo;
							</blockquote>
							<p class='author'><cite>${res.first_name} ${res.last_name}</cite></p>
						</div>
					</div>`;
            }
          $("#topKomentari").html(ispis);
        },
        error : function(xhr){
        
        }
    });
}
function userMessage(){
 
     let message = $("#userMessage");
     let reMessage = /^.{3,255}$/;
     if(!reMessage.test(message.val())){
         message.css("border-color", "#FF5722");
         message.next().html("Please write something with min 3 and max 255 characters.");
     }else{
        message.css("border-color", "#58a6a6");
        $.ajax({
            url : "models/messages/insert.php",
            method : "POST",
            dataType : "json",
            data : {
                message : message.val()
            },
            success : function(result){
                message.next().html(`<br/><p class="alert alert-success">${result.message}</p>`);
            },
            error : function(xhr){
                
            }
        }); 
     }
}
function reserveRoom(e){
    e.preventDefault();

    let tipSobe = $("#tipSobe").val();
    let brojOsoba = $("#brojOsoba").val();
    let danas = Date.now();
    let datumOd = Date.parse($("#date-start").val());
    let datumDo = Date.parse($("#date-end").val());
    let idSobe = $(this).data("idsobe");
    let brojGresaka = 0;
    let poruka = [];
   
    if(tipSobe == null){
        brojGresaka++;
        poruka.push("Please select type of room.");
    }
    if(brojOsoba == null){
        brojGresaka++;
        poruka.push("Please select number of guests.");
    }
    if((datumOd - datumDo) > 0){
        brojGresaka++;
        poruka.push("Check out can't be before check in.");
    }
    if((danas - datumOd) > 0 || (danas - datumDo) > 0){
        brojGresaka++;
        poruka.push("You selected dates that are in past.");
    }
    if(isNaN(datumOd) || isNaN(datumDo)){
        brojGresaka++;
        poruka.push("Please select dates.");
    }
    let ispis = ""; 
    if(brojGresaka){
        for(let por of poruka){
            ispis += `<p class="alert alert-danger">${por}</p>`
        }
        $("#responseReserv").html(ispis);
    }
    else{
        $.ajax({
            url : "models/reservations/reservation.php",
            method : "POST",
            dataType : "json",
            data : {
                tipSobe : tipSobe,
                brojOsoba : brojOsoba,
                datumOd : $("#date-start").val(),
                datumDo : $("#date-end").val(),
                idSobe : idSobe
            },
            success : function(result){
               $("#responseReserv").html(`<p class="alert alert-success">${result.message}</p>`);
            },
            error : function(xhr){
                if(xhr.status == 401){
                    $("#responseReserv").html(`<p class="alert alert-danger">You must be logged in to make a reservation.</p>`);
                }
            }
        });
    }
}
function updateRoom(){
    let id = $(this).data("id");
    $("#nameRoom").val($("#room"+id).text());
    $("#album").val($("#album"+id).text());
    $("#description").val($("#description"+id).text());
    $("#insertUpdate").val("Update");
    localStorage.setItem("idRoom", id);
}
function updateInsertRoom(){
    var idRoom = localStorage.getItem("idRoom");
    var nameRoom = $("#nameRoom").val();
    var album = $("#album").val();
    var description = $("#description").val();
    var priceBr2 = parseInt($("#priceBr2").val());
    var priceRfr2 = parseInt($("#priceRfr2").val());
    var priceBr3 = parseInt($("#priceBr3").val());
    var priceRfr3 = parseInt($("#priceRfr3").val());
    var photoInputs = $("input[name='files[]']");
    var photos = [];
    var button = $("#insertUpdate").val();
    var message = "";

    console.log(photoInputs);
   for(let p of photoInputs){
        photos.push(p[0].files[0]);
   }

    if(nameRoom == "" || album == "" || description == ""){
        message += "Name, description and album fields are required.<br/>";
    }
    if(priceBr2 <= 0 || priceBr3 <= 0 || priceRfr2 <= 0 || priceBr3 <= 0
        || isNaN(priceBr2) || isNaN(priceBr3) || isNaN(priceRfr2) || isNaN(priceRfr3)){
        message += "Prices must be number above zero.<br/>";
    }

    if(message != ""){
            $("#errorInsertUpdate").html(`<p class="alert alert-danger">${message}</p>`);
    }
    else{

        let dataRoom = new FormData();
        dataRoom.append("nameRoom", nameRoom);
        dataRoom.append("album", album);
        dataRoom.append("description", description);
        dataRoom.append("priceBr2", priceBr2);
        dataRoom.append("priceBr3", priceBr3);
        dataRoom.append("priceRfr2", priceRfr2);
        dataRoom.append("priceRfr3", priceRfr3);
        dataRoom.append("photo", photo);
        dataRoom.append("idRoom", idRoom);

        // $.ajax({
        //     url : button == "Update" ? "models/rooms/update.php" : "models/rooms/insert.php",
        //     method : "POST",
        //     dataType : "json",
        //     data : dataRoom,
        //     contentType:false,
        //     processData: false,
        //     success : function(result){
        //         $("#errorInsertUpdate").html(`<br/><p class="alert alert-success">${result.message}</p>`);
        //     },
        //     error : function(xhr){
        //         if(xhr.status == 500){
        //             $("#errorInsertUpdate").html(`<p class="alert alert-danger">Internal Server Error</p>`);
        //         }
        //     }
        // }); 
    }
}
function filterSortRooms(e){
    e.preventDefault();

    let roomCat = $("#roomCat").val();
    let guestsNum = $("#guestsNum").val();
    let accType = $("#accType").val();
    let sortPrice = $("#sortPrice").val();

    $.ajax({
        url: "models/rooms/filterAndSort.php",
        method: "POST",
        dataType: "json",
        data: {
            roomCat : roomCat,
            guestsNum : guestsNum,
            accType : accType,
            sortPrice : sortPrice
        },
        success: function(rooms){
            let ispis = "";
            let roomNames = [];
            for(let room of rooms){
                if(!roomNames.includes(room.room_name)){
                    roomNames.push(room.room_name);
                }
            }
			for(let roomName of roomNames){
                for(let room of rooms){
                    if(roomName == room.room_name){
                        ispis += `<div class='row'><div class='col-lg-5'>
                        <img width='100%' src='assets/images/${room.album}/${room.src}' alt='${room.alt}'></div>
                        <div class='col-lg-7'><h2>${roomName}</h2>
                        <p>${room.description}</p></div></div><hr>`;
                        break;
                    }
                }
                for(let room of rooms){
                    if(roomName == room.room_name){
                        ispis += `<div class='row'>
                        <div class='col-lg-4'><p>${room.name_type}</p></div>
                        <div class='col-lg-3'><p>${room.number_ppl} Gusets</p></div>
                        <div class='col-lg-3'><p>${room.price} &yen;</p></div>
                        <div class='col-lg-2'><a href='index.php?page=accommodation&idRoom=${room.id_room}' class='btn btn-primary btn-luxe-primary'>Book Now</a></div>
                        </div>
                        <hr>`;
                    }
                }
            }

            $("#accommodations").html(ispis);
        },
        error : function(xhr){
            console.log(xhr);
        }
    });

}
function ajaxCallBack(url, method, data, result, error){
    $.ajax({
        url: url,
        method: method,
        data: data,
        dataType: "json",
        success: result,
        error : error
    });
}

});

