var speed = 1.0;
function setPlaySpeed() { 
    var vid = document.getElementById("myVideo");
    var knapp = document.getElementById("knapp2");
    speed = speed + 0.5;
    if (speed == 1.3) {
        speed = 1.0;
    }
    if (speed > 2.0) {
        speed = 0.8;
    }
    vid.playbackRate = speed;
    knapp.value = "x"+speed.toFixed(1);
    //alert(knapp.value);
} 