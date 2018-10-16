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

window.setInterval(function(t){
    if (myVideo.readyState > 0) {
      var duration = jQuery('#myVideoLength').get(0);
      var vid_duration = Math.floor(myVideo.duration);
      var minutes = parseInt(vid_duration / 60, 10);
	  var seconds = vid_duration % 60;
      duration.firstChild.nodeValue = minutes + ':' + seconds;
      clearInterval(t);
    } 
  },200);