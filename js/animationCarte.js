// document.querySelector("#showCall").onclick = () =>{
//     let w = document.querySelector("#parentDC");
//     w.classList.remove('callHide');
//     w.classList.add('callShow');
// }

// document.querySelector("#CloseCall").onclick = () =>{
//     let w = document.querySelector("#parentDC");
//     w.classList.add('callHide');
//     w.classList.remove('callShow');
// }


    $("#parentDC").slideUp(2);
    $("#charh").slideUp(1);
    $("#showCall").on('click',function () { 
        $("#parentDC").slideToggle(700);
        console.log("ok");
    });
    $("#CloseCall").on('click',function () { 
        $("#parentDC").fadeToggle(500);
        console.log("ok");
    });


    $('#seeMore').on('click', function(){
        // $('.resizable').css('height', '70vh');
        $('.resizable').animate({height: '70vh'}, 800);
        $('#seeLess').removeAttr('hidden');
        $(this).attr('hidden', 'true');
    });
    
    $('#seeLess').on('click', function(){
        // $('.resizable').css('height', '10vh');
        $('.resizable').animate({height: '10vh'}, 500);
        $('#seeMore').removeAttr('hidden');
        $('#seeLess').attr('hidden', 'true');
    });
