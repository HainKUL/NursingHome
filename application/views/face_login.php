<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Camera</title>
    <link rel="stylesheet" href="../../assets/css/face_login.css">
</head>

<body>
<h2>{welcome}</h2>
<h1>{login}</h1>

<div class="booth">
    <video id="video" width="400" height="300"></video>
    <a href="#" id="capture" class="booth-caputre-button">Take Photo</a>
    <button onClick="saveFile(filename);" >Download</button>

    <canvas id="canvas" width="400" height="300"></canvas>
    <img id="photo" src="../../assets/photos/login.png">
</div>

<script src="../../assets/js/photo.js"></script>

</body>
</html>