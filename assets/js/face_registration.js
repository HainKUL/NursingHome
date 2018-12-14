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

    init();
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

    console.log("camera open");
}

function snapshot() {
    ctx.drawImage(video, 0,0, canvas.width, canvas.height);
    var img1 = new Image();
    img1.src = canvas.toDataURL();
    var id = '<%=Session["reg_id"]%>';
     var ip = document.getElementById('ip').value;
    datad = "{\r\n    \"image\":\"" + img1.src+ "\",\r\n    \"subject_id\":\"" + ip + "\",\r\n    \"gallery_name\":\"Demo\"\r\n}";
    var settings = {
        "async": true,
        "crossDomain": true,
        "url": "https://api.kairos.com/enroll",
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

        if((response.images[0].transaction.status) == "success"){
            //Materialize.toast("Image Trained succesfully by name " +response.images[0].transaction.subject_id+ " in gallery name " +response.images[0].transaction.gallery_name, 4000);
            console.log("successfully registered")
            alert("successfully registered")
            // let newUrl = site_url.concat("/index.php/Dashboard/dashboard")
            // console.log(newUrl);
            // //set a timer
            // setTimeout(myFunc,1000);
            // function myFunc() {
            //     window.location.href = newUrl;
            // }
        }
        else{
            //Materialize.toast("Unable to Train Image", 4000);
            alert("failed with registration")
        }
    });
    //console.log(img1.src);
}