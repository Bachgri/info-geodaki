//
//var vv=0;

var villes = ['TfG0gw==', 'QeKrkM0kSkwl', 'WOK3hck9', 'XuK7g9g='];
function createCookie(name, value, days) {
    var expires;

    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toGMTString();
    } else {
        expires = "";
    }
    document.cookie = encodeURIComponent(name) + "=" + encodeURIComponent(value) + expires + "; path=/";
}

function readCookie(name) {
    var nameEQ = encodeURIComponent(name) + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) === ' ')
            c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) === 0)
            return decodeURIComponent(c.substring(nameEQ.length, c.length));
    }
    return null;
}

function eraseCookie(name) {
    createCookie(name, "", -1);
}

function check(v, passd, login){
    console.log('====================================');
    console.log(v + " " + villes[v] + "  " + login + "  " + passd);
    console.log('====================================');
    if(v<villes.length){
        $.ajax({
            url: './dd.php',
            method: 'GET',
            data: {
                ville: villes[v]
            },
            success: (d) => {
                console.log('====================================');
                console.log(d);
                console.log('====================================');
                $.ajax({ 
                    method: 'POST',
                    url  : 'login.php',//$("#FormLogin").attr("action"),
                    data : {
                        login : login,
                        password : passd
                    },
                    success : function(d){
                        console.log(d);
                        $("#FormLogin").submit(function () { return false });
                        if(d == "No"){
                            /* if(d=="No")*/
                        }else {  
                            $('.container').animate({'right': '100%'});
                            $('#imgWait').animate({'right': '0'});
                            IDUSER = d.split('|')[1];
                            createCookie('iduserST', IDUSER, 0.1);
                            location.reload(true);  
                            return;
                            // window.location = "http://192.168.100.23/PHP/appk/";
                            console.log(d + ' ' + IDUSER);
                        } 
                        v++;
                        check(v, passd, login);
                    }
                });
            }
        }) 
    }else{
        $('#imgWait').css({'right': '120%'})
        $("#txtErr").text("email ou mot de passe incorrecte");
        $("#txtErr").fadeIn(100);
        $("#txtErr").fadeOut(100); $("#txtErr").fadeIn(100);
        $("#txtErr").fadeOut(100); $("#txtErr").fadeIn(100);
        $("#txtErr").fadeOut(100); $("#txtErr").fadeIn(100);
    }
}
$(document).ready(function () { 
    /*
    $("#ville").on('click', function(){
        var vi = document.querySelector('#ville').value;
        $.ajax({
            url: 'dd.php',
            method: 'GET',
            data: {
                ville: vi
            },
            success: (d) => {
                console.log('====================================');
                console.log(d);
                console.log('====================================');
            }
        })
    })*/
    var v = 0;
    $("#btnLogin").on('click', function(){
        var login = $("#login").val();
        var passd = $("#password").val(); 
        $('#imgWait').css({'right': '0'})
        $("#txtErr").text("");
        $("#FormLogin").submit(function () { return false });
        // var ville = document.querySelector('#ville').value;
        // console.log('====================================');
        // console.log(ville);
        // console.log('====================================');
        if(login != "" || passd != ""){            
            check(0, passd, login); 
            //console.log(d);        
            
        }else 
            $("#FormLogin").submit(function () { return false });
        // if(ville != '0'){
        // }else{
        //     document.getElementById('ville').style.color = 'red'
        //     document.querySelector('.fa-globe').style.color = 'red'
        // }
    });
    $("#out").on('click', function () { 
            console.log("Loging out");
    });
});  

// const btnL = document.querySelector("#btnLogin");