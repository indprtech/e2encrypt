<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Error 500 - Internal Server Error</title>
	<style>
		body {
			background-color: #f9f9f9;
			font-family: Arial, sans-serif;
			margin: 0;
			padding: 0;
			display: flex;
			flex-direction: column;
			align-items: center;
			justify-content: center;
			height: 100vh;
		}
		.container {
			background-color: #fff;
			border-radius: 10px;
			box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
			padding: 50px;
			text-align: center;
			max-width: 500px;
			margin: 0 auto;
		}
		h1 {
			color: #ff5a5f;
			font-size: 36px;
			margin-bottom: 10px;
		}
		p {
			color: #666;
			font-size: 18px;
			line-height: 1.5;
			margin-bottom: 30px;
		}
		.btn {
			display: inline-block;
			background-color: #ff5a5f;
			color: #fff;
			font-size: 18px;
			padding: 10px 20px;
			border-radius: 5px;
			text-decoration: none;
			transition: background-color 0.3s ease;
		}
		.btn:hover {
			background-color: #ff4246;
		}
	</style>
</head>
<body>
	<div class="container">
		<h1>Error 500 - Internal Server Error</h1>
		<p><?=$message?></p>
		<a href="javascript:window.location.reload()" class="btn">Reload</a>
	</div>
</body>
</html>
