navigator.getUserMedia = ( navigator.getUserMedia ||
    navigator.webkitGetUserMedia ||
    navigator.mozGetUserMedia ||
    navigator.msGetUserMedia);

var video;
var webcamStream;

function startWebcam() {
    if (navigator.getUserMedia) {
        navigator.getUserMedia (
            // constraints
            {
                video: true,
                audio: false
            },

            // successCallback
            function(localMediaStream) {
                video = document.querySelector('video');
                video.src = window.URL.createObjectURL(localMediaStream);
                webcamStream = localMediaStream;
            },

            // errorCallback
            function(err) {
                console.log("The following error occured: " + err);
            }
        );
    } else {
        console.log("getUserMedia not supported");
    }
}


//---------------------
// TAKE A SNAPSHOT CODE
//---------------------
var canvas, ctx;

function init() {
    // Get the canvas and obtain a context for
    // drawing in it
    canvas = document.getElementById("myCanvas");
    ctx = canvas.getContext('2d');
}

function snapshot() {
    ctx.drawImage(video, 0,0, canvas.width, canvas.height);
    var img1 = new Image();
    img1.src = canvas.toDataURL();
    // var x = document.getElementById("myAudio");
    // x.play();
    datad = "{\r\n    \"image\":\"" + img1.src+ "\",\r\n    \"gallery_name\":\"Arti\"\r\n}"
    var settings = {
        "async": true,
        "crossDomain": true,
        "url": "https://api.kairos.com/recognize",
        "method": "POST",
        "headers": {
            "content-type": "application/json",
            "app_id": "c09c520d",
            "app_key": "3f38ca5aeaac24c10eb08945e6f277b7",
            "cache-control": "no-cache"
        },
        "processData": false,
        "data": datad
    }
    $.ajax(settings).done(function (response) {
        var m = response;
        //console.log("hello");
        //console.log(JSON.stringify(m).indexOf("success"));//if not exist, return -1; else return the index of first occurance
        //console.log("world");
        if(JSON.stringify(m).indexOf("success") > -1) {//obj found
            Materialize.toast('User Identfied. Name : ' +JSON.stringify(m.images[0].candidates[0].subject_id), 6000);
            //console.log(m.images[0].candidates[0].subject_id);//Haien

        }
        else{
            Materialize.toast('User Not identified');
        }
    });
}
