let ulsCE = [];

function addCENumber(){
    // sep = $('<ul class="separator"></ul>');
    // $("#uls").append(sep);
    for(var c=0;c<CENums.length;c++){
        ul1 = $(''); 
        li1 = $('<li style="text-align: left" >' + CENums[c][3] + ' </li>');
        li2 = $('<li id="ce" style="text-align:left"></li>');
        link = $('<a href="tel:'+ CENums[c][2] +'" id="tel">'+ CENums[c][1] +'</a>');
        svg = $('<svg style="color:black" class="av-icon" height="24" width="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-labelledby="PhoneLineTitleID" style="fill: currentcolor; stroke: currentcolor; stroke-width: 0;"><title id="PhoneLineTitleID">PhoneLine Icon</title><path d="M9.366 10.682a10.556 10.556 0 003.952 3.952l.884-1.238a1 1 0 011.294-.296 11.422 11.422 0 004.583 1.364 1 1 0 01.921.997v4.462a1 1 0 01-.898.995A15.51 15.51 0 0118.5 21C9.94 21 3 14.06 3 5.5c0-.538.027-1.072.082-1.602A1 1 0 014.077 3h4.462a1 1 0 01.997.921A11.422 11.422 0 0010.9 8.504a1 1 0 01-.296 1.294l-1.238.884zm-2.522-.657l1.9-1.357A13.41 13.41 0 017.647 5H5.01c-.006.166-.009.333-.009.5C5 12.956 11.044 19 18.5 19c.167 0 .334-.003.5-.01v-2.637a13.41 13.41 0 01-3.668-1.097l-1.357 1.9a12.442 12.442 0 01-1.588-.75l-.058-.033a12.556 12.556 0 01-4.702-4.702l-.033-.058a12.442 12.442 0 01-.75-1.588z"></path></svg>');
        li2.append(svg);
        li2.append(link);
        ul1.append(li1);
        ul1.append(li2);
        $("#uls").append(ul1); 
        ulsCE.push(ul1);
    }
}
document.querySelector('#vueTabCoCo').addEventListener('click', (e)=>{
    console.log("vue tabulaire Collecte bacs ");
})