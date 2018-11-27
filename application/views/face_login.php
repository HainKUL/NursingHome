<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Camera</title>
    <link rel="icon" href="<?=base_url()?>assets/photos/favicon.png" type="image/gif" sizes="16x16">

    <style>
        video{
            height: 400px;
            width: 400px;
            border: thin solid silver;
        }
    </style>
</head>

<body>
<h2>{welcome}</h2>
<h1>{login}</h1>

<button id="capture">{capture}</button>
<video autoplay></video>
<div id="loadInfo"></div>

<script>
document.getElementById("capture").addEventListener('click',capture)
    function capture() {
        navigator.mediaDevices.getUserMedia({video:true, audio:false})
            .then(function (stream) {
                const video =document.querySelector("video")
                video.srcObject = stream
            })
        .catch(e => console.log("error "+e))
    }
</script>
</body>
</html>