require "loginCheck.php"

<!DOCTYPE html>
<html>
<head>
	<title>Dashobaord</title>
</head>
<body>
	Welcome <?php echo htmlspecialchars($_SESSION["email"], ENT_QUOTES, 'UTF-8');?>
</body>
</html>