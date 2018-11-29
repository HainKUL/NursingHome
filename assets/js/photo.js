var video = document.getElementById('video'),
    canvas = document.getElementById('canvas'),
    context = canvas.getContext('2d'),
    photo = document.getElementById('photo'),
    vendorURL = window.URL || window.webkitURL;

navigator.getMedia = navigator.getUserMedia ||
    navigator.webkitGetUserMedia ||
    navigator.mozGetUserMedia ||
    navigator.msGetUserMedia;

navigator.getMedia({
    video:true,
    audio: false
},function (stream) {
    video.src = vendorURL.createObjectURL(stream);
    video.play();
},function (error) {
    //an error occur
    //error.code
});

document.getElementById('capture').addEventListener('click',function () {
    context.drawImage(video,0,0,400,300);
    photo.setAttribute('src', canvas.toDataURL('image/png'))//pass image typee
});



//save picture from canvas and rename it by certain rule
var type = 'png';

var _fixType = function(type) {
    type = type.toLowerCase().replace(/jpg/i, 'jpeg');//replace 1st by 2nd element
    var r = type.match(/png|jpeg|bmp|gif/)[0];
    return 'image/' + r;
};


/**
 * @param  {String} filename
 */
var saveFile = function(filename){
    //get image content from canvas
    var imgData = document.getElementById('canvas').toDataURL(type);
    imgData = imgData.replace(_fixType(type),'image/octet-stream');
    console.log(imgData);

    var save_link = document.createElementNS('http://www.w3.org/1999/xhtml', 'a');
    save_link.href = imgData;
    save_link.download = filename;

    var event = document.createEvent('MouseEvents');
    event.initMouseEvent('click', true, false, window, 0, 0, 0, 0, 0, false, false, false, false, 0, null);
    save_link.dispatchEvent(event);
};

//renaming rule when downloading
var filename = (new Date()).getTime() + '.' + type;

