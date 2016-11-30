<?php

session_start();

if ((!isset($_SESSION['udanarejestracja'])))
	{
		header('Location: index.php');
		exit();
	}

echo 'Rejestracja powiodła się!';
echo 'Można się zalogować.';

?>
<html>

<br>

<div>
<form action="index.php" method="post">

<input type="submit" value="OK"/>

</form>
</div>

</html>