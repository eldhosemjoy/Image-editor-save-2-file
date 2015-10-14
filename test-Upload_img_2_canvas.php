<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<link rel="shortcut icon" href="favicon.ico" />
<style>
h3 {
	font-weight: 			bold;
	margin: 				0 20px 10px 0;
	padding: 				0px 0px 5px;
	text-align: 			center;
	border-bottom: 			2px #333 groove;
}
input {
	margin: 				0 auto;
	display: 				block;
	text-align: 			center;
}
canvas {
	margin: 				0 auto;
	padding: 				2%;
	display: 				block;
	border: 				6px #333 double;
	box-shadow: 			0px 0px 5px 5px #333 inset,
	 						0px 0px 0px 5px #fff inset,
							0px 0px 10px 5px #333 inset,
							0px 0px 0px 5px #fff inset,
							0px 0px 10px 5px #333 inset;
}
.canvasFrame {
	margin: 				10px auto;
}
</style>
</head>

<body>

<div>
<h3>Upload Image to Canvas:</h3>
<input type="file" id="imageLoader" name="imageLoader"/>
</div>

<div class="canvasFrame">
<canvas id="imageCanvas"></canvas>
</div>

<script>
var imageLoader = document.getElementById('imageLoader');
    imageLoader.addEventListener('change', handleImage, false);
var canvas = document.getElementById('imageCanvas');
var ctx = canvas.getContext('2d');

function handleImage(e){
    var reader = new FileReader();
    reader.onload = function(event){
        var img = new Image();
        img.onload = function(){
            canvas.width = img.width;
            canvas.height = img.height;
            ctx.drawImage(img,0,0);
        }
        img.src = event.target.result;
    }
    reader.readAsDataURL(e.target.files[0]);     
}
</script>
</body>
</html>