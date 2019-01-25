navigator.getUserMedia = ( navigator.getUserMedia ||
    navigator.webkitGetUserMedia ||
    navigator.mozGetUserMedia ||
    navigator.msGetUserMedia);

let video;
let webcamStream;
let canvas, ctx;
canvas = document.getElementById("myCanvas");
ctx = canvas.getContext('2d');

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

function snapshot_login() {
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
        let m = response;
        //if user verified
        if(JSON.stringify(m).indexOf("success") > -1) {//converts a JavaScript object or value to a JSON string
            //Materialize.toast('User Identfied. ID : ' +JSON.stringify(m.images[0].candidates[0].subject_id), 6000);
            //show the id returned from the cloud
            console.log(m.images[0].candidates[0].subject_id);//by default returns 10 images/candidates sorted by similarity
            //switch to user page
            let base_url = window.location.origin.concat("/a18ux04");
            //check localhost or server
            if(!base_url.includes("localhost"))
                base_url = "https://a18ux04.studev.groept.be";
            //console.log(base_url);
            //need to match name with id in db, or alternatively send query with name instead of id
            let userID = m.images[0].candidates[0].subject_id;
            let newUrl = base_url.concat("/index.php/Homepage_controller/successlogin/").concat(userID);
            console.log(newUrl);
            //set a timer to prevent fast switching
            setTimeout(myFunc,1500);
            function myFunc() {
                window.location.href = newUrl;
            }
        }
        //if user not identified
        else{
            alert("Sorry, please try again ☹")
        }
    });
}

function snapshot_registration() {
    ctx.drawImage(video, 0,0, canvas.width, canvas.height);
    let img1 = new Image();
    img1.src = canvas.toDataURL();
    let ip = document.getElementsByTagName("h4")[0].innerHTML;
    let cgid=document.getElementsByTagName("h5")[0].innerHTML;
    //console.log(ip);
    datad = "{\r\n    \"image\":\"" + img1.src+ "\",\r\n    \"subject_id\":\"" + ip + "\",\r\n    \"gallery_name\":\"Project\"\r\n}";
    var settings = {
        "async": true,
        "crossDomain": true,
        "url": "https://api.kairos.com/enroll",
        "method": "POST",
        "headers": {
            "content-type": "application/json",
            "app_id": "3d48ca50",
            "app_key": "e9e2ad6e32b4224227e2fd1347a6c3ec",
            "cache-control": "no-cache"
        },
        "processData": false,
        "data": datad
    }

    $.ajax(settings).done(function (response) {
        //successfully registered
        if((response.images[0].transaction.status) == "success"){
            //console.log("successfully registered")
            alert("successfully registered!")
            let base_url = window.location.origin.concat("/a18ux04");
            //check server or localhost
            if(!base_url.includes("localhost"))
                base_url = "https://a18ux04.studev.groept.be";
            let newUrl = base_url.concat("/index.php/Dashboard/registrationsucces/").concat(cgid);
            //console.log(newUrl);
            window.location.href = newUrl;
        }
        else{
            alert("failed with registration!")
        }
    });
}
