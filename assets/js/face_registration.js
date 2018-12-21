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
                // video.src = window.URL.createObjectURL(localMediaStream);
                video.srcObject = localMediaStream;
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


var canvas, ctx;
canvas = document.getElementById("myCanvas");
ctx = canvas.getContext('2d');
//
// function init() {
//     // Get the canvas and obtain a context for
//     // drawing in it
//     canvas = document.getElementById("myCanvas");
//     ctx = canvas.getContext('2d');
//
//     console.log("camera open");
// }

function snapshot() {
    ctx.drawImage(video, 0,0, canvas.width, canvas.height);
    var img1 = new Image();
    img1.src = canvas.toDataURL();
    // var ip = document.getElementById('ip').value;
    var ip = document.getElementsByTagName("h4")[0].innerHTML;
    var cgid=document.getElementsByTagName("h5")[0].innerHTML;
    console.log(ip);
    datad = "{\r\n    \"image\":\"" + img1.src+ "\",\r\n    \"subject_id\":\"" + ip + "\",\r\n    \"gallery_name\":\"Demoxx\"\r\n}";
    var settings = {
        "async": true,
        "crossDomain": true,
        "url": "https://api.kairos.com/enroll",
        "method": "POST",
        "headers": {
            "content-type": "application/json",
            "app_id": "76389211",
            "app_key": "235ed78f4f2967f3f4648ee6557623dc",
            "cache-control": "no-cache"
        },
        "processData": false,
        "data": datad
    }

    $.ajax(settings).done(function (response) {

        if((response.images[0].transaction.status) == "success"){
            //Materialize.toast("Image Trained succesfully by name " +response.images[0].transaction.subject_id+ " in gallery name " +response.images[0].transaction.gallery_name, 4000);
            console.log("successfully registered")
            alert("successfully registered")
            let base_url = window.location.origin.concat("/a18ux04");
            if(!base_url.includes("localhost"))
            //if(base_url!="http://localhost/a18ux04")
                base_url = "https://a18ux04.studev.groept.be";
            let newUrl = base_url.concat("/index.php/Dashboard/registrationsucces/").concat(cgid);

            console.log(newUrl);
            window.location.href = newUrl;
        }
        else{
            //Materialize.toast("Unable to Train Image", 4000);
            alert("failed with registration")
        }
    });
    //console.log(img1.src);
}