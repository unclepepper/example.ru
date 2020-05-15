<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Game</title>
</head>

<body>

    
<canvas id="canvas"></canvas>


<script type="text/javascript">
	var canvas = document.getElementById('canvas');
	ctx = canvas.getContext('2d');
	var ballRadius = 20;
	var posX = 20;
	var speedX =5;
	var posY = 20;
	var speedY =7;

	function drawBall(){
		
		if (posY + speedY > canvas.height) {
			speedY = -7;
		}else if (posX + speedX > canvas.width) {
			speedX = -5;
		}else if (posY + speedY < 0) {
			speedY = 7;
		}else if (posX + speedX < 0) {
			speedX = 5;
		}
		
		ctx.beginPath();
		ctx.arc(posX,posY,ballRadius,0,Math.PI*2, false);
		ctx.fillStyle = '#F37A00';
		ctx.fill();
		ctx.closePath();
	}
	function draw(){
		ctx.clearRect(0,0,canvas.width,canvas.height);
		drawBall();
		posX += speedX;
		posY += speedY;


	}

	setInterval(draw, 1000/30);
	
	

</script>
</body>

</html>
