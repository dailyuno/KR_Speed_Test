<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title></title>
</head>
<body>
	<p>Enter the below security code here</p>
	<form action="result.php" method="POST">
        <img src="code.php" alt=""><br>
		<label for="code">Security Code:
			<input type="text" name="code" id="code">
		</label>
        <p>Can't read? <a href="">Refresh</a></p>
		<input type="submit" />
	</form>
</body>
</html>