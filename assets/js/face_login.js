navigator.getUserMedia = ( navigator.getUserMedia ||
    navigator.webkitGetUserMedia ||
    navigator.mozGetUserMedia ||
    navigator.msGetUserMedia);

var video;
var webcamStream;

function startWebcam() {
    if (navigator.getUserMedia) {
        navigator.getUserMedia (
            {// constraints
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

function snapshot() {
    ctx.drawImage(video, 0,0, canvas.width, canvas.height);
    var img1 = new Image();
    img1.src = canvas.toDataURL();
    datad = "{\r\n    \"image\":\"" + img1.src+ "\",\r\n    \"gallery_name\":\"Project\"\r\n}"
    var settings = {
        "async": true,
        "crossDomain": true,
        "url": "https://api.kairos.com/recognize",
        "method": "POST",
        "headers": {
            "content-type": "application/json",
            "app_id": "3d48ca50",
            "app_key": "e9e2ad6e32b4224227e2fd1347a6c3ec",
            "cache-control": "no-cache"
        },
        "processData": false,
        "data": datad
    };

    //loading in process
    console.log("verifying in process");

    $.ajax(settings).done(function (response) {
        var m = response;

        //if user verified
        if(JSON.stringify(m).indexOf("success") > -1) {
            Materialize.toast('User Identfied. ID : ' +JSON.stringify(m.images[0].candidates[0].subject_id), 6000);
            console.log(m.images[0].candidates[0].subject_id);//show the id returned from the cloud
            //switch to user page
            let base_url = window.location.origin.concat("/a18ux04");
            //console.log(base_url);
            // if(base_url!="http://localhost/a18ux04")
            if(!base_url.includes("localhost"))
                base_url = "https://a18ux04.studev.groept.be";
            console.log(base_url);
            //need to match name with id in db, or alternatively send query with name instead of id
            let userID = m.images[0].candidates[0].subject_id;
            //let newUrl = base_url.concat("/index.php/Questionnaire_controller/questionnaire_start/").concat(userID);
            let newUrl = base_url.concat("/index.php/Homepage_controller/successlogin/").concat(userID);

            console.log(newUrl);
            //set a timer
            setTimeout(myFunc,2000);
            function myFunc() {
                window.location.href = newUrl;
            }
        }
        //if user not identified
        else{
            //Materialize.toast('Sorry, please try again ☹');
            alert("Sorry, please try again ☹")
        }
    });
}
