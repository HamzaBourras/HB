 function afficherposition(){
    var position=document.getElementById('pos').value;
    var iframe=document.getElementById('iframe');

        //construire l'url
    var mapUrl = "https://www.google.com/maps?q=" + encodeURIComponent(position) + "&output=embed";

    iframe.src=mapUrl;
 }