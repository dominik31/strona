<?php

session_start();
if ((!isset($_SESSION['zalogowany'])))
	{
		header('Location: index.php');
		exit();
	}
?>

<html>

<div>

Musisz wybrać typ aukcji:

<form action="aukcja_klasyczna.php" method="post"><input type="submit" value="AUKCJA KLASYCZNA"></form>
<form action="aukcja_min.php" method="post"><input type="submit" value="AUKCJA Z CENĄ MINIMALNĄ"></form>
<form action="aukcja_holenderska.php" method="post"><input type="submit" value="AUKCJA HOLENDERSKA"></form>
<hr><hr>
<form action="strona_usera.php" method="post"><input type="submit" value="WRÓĆ"></form>




</div>

</html>