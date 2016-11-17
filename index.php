<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<title>Strona aukcyjna</title>
	<link rel="stylesheet" text type="text/css" href="style.css">
</head>

<body>
<?php

session_start();

	if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
	{
		header('Location: strona_usera.php');
		exit();
	}

	
	
	require_once "connect.php";
		mysqli_report(MYSQLI_REPORT_STRICT);
		
		$wszystko_OK=true;
		
		try 
		{
			$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
			if ($polaczenie->connect_errno!=0)
			{
				throw new Exception(mysqli_connect_errno());
			}
			else
			{	
			

				
				if(isset($_POST['klasyczna']))
				{
					$pozycja1 = $polaczenie->query("SELECT * FROM klasyczna ORDER BY id DESC LIMIT 1");
					$wiersz = $pozycja1->fetch_assoc();
					$_SESSION['nazwa1'] = $wiersz['nazwa'];
					$_SESSION['opis1'] = $wiersz['opis'];
					$_SESSION['data_r1'] = $wiersz['data_r'];
					$_SESSION['godzina_r1'] = $wiersz['godzina_r'];
					$_SESSION['data_z1'] = $wiersz['data_z'];
					$_SESSION['godzina_z1'] = $wiersz['godzina_z'];
					$_SESSION['cena_w1'] = $wiersz['cena_w'];
					$_SESSION['obraz1'] = $wiersz['obraz'];
					
					$pozycja2 = $polaczenie->query("SELECT * FROM klasyczna ORDER BY id DESC LIMIT 1,1");
					$wiersz = $pozycja2->fetch_assoc();
					$_SESSION['nazwa2'] = $wiersz['nazwa'];
					$_SESSION['opis2'] = $wiersz['opis'];
					$_SESSION['data_r2'] = $wiersz['data_r'];
					$_SESSION['godzina_r2'] = $wiersz['godzina_r'];
					$_SESSION['data_z2'] = $wiersz['data_z'];
					$_SESSION['godzina_z2'] = $wiersz['godzina_z'];
					$_SESSION['cena_w2'] = $wiersz['cena_w'];
					$_SESSION['obraz2'] = $wiersz['obraz'];
					
					$pozycja3 = $polaczenie->query("SELECT * FROM klasyczna ORDER BY id DESC LIMIT 2,1");
					$wiersz = $pozycja3->fetch_assoc();
					$_SESSION['nazwa3'] = $wiersz['nazwa'];
					$_SESSION['opis3'] = $wiersz['opis'];
					$_SESSION['data_r3'] = $wiersz['data_r'];
					$_SESSION['godzina_r3'] = $wiersz['godzina_r'];
					$_SESSION['data_z3'] = $wiersz['data_z'];
					$_SESSION['godzina_z3'] = $wiersz['godzina_z'];
					$_SESSION['cena_w3'] = $wiersz['cena_w'];
					$_SESSION['obraz3'] = $wiersz['obraz'];
					
				}
				else if(isset($_POST['min']))
				{
					$pozycja1 = $polaczenie->query("SELECT * FROM min ORDER BY id DESC LIMIT 1");
					$wiersz = $pozycja1->fetch_assoc();
					$_SESSION['nazwa1'] = $wiersz['nazwa'];
					$_SESSION['opis1'] = $wiersz['opis'];
					$_SESSION['data_r1'] = $wiersz['data_r'];
					$_SESSION['godzina_r1'] = $wiersz['godzina_r'];
					$_SESSION['data_z1'] = $wiersz['data_z'];
					$_SESSION['godzina_z1'] = $wiersz['godzina_z'];
					$_SESSION['cena_w1'] = $wiersz['cena_w'];
					$_SESSION['obraz1'] = $wiersz['obraz'];
					
					$pozycja2 = $polaczenie->query("SELECT * FROM min ORDER BY id DESC LIMIT 1,1");
					$wiersz = $pozycja2->fetch_assoc();
					$_SESSION['nazwa2'] = $wiersz['nazwa'];
					$_SESSION['opis2'] = $wiersz['opis'];
					$_SESSION['data_r2'] = $wiersz['data_r'];
					$_SESSION['godzina_r2'] = $wiersz['godzina_r'];
					$_SESSION['data_z2'] = $wiersz['data_z'];
					$_SESSION['godzina_z2'] = $wiersz['godzina_z'];
					$_SESSION['cena_w2'] = $wiersz['cena_w'];
					$_SESSION['obraz2'] = $wiersz['obraz'];
					
					$pozycja3 = $polaczenie->query("SELECT * FROM min ORDER BY id DESC LIMIT 2,1");
					$wiersz = $pozycja3->fetch_assoc();
					$_SESSION['nazwa3'] = $wiersz['nazwa'];
					$_SESSION['opis3'] = $wiersz['opis'];
					$_SESSION['data_r3'] = $wiersz['data_r'];
					$_SESSION['godzina_r3'] = $wiersz['godzina_r'];
					$_SESSION['data_z3'] = $wiersz['data_z'];
					$_SESSION['godzina_z3'] = $wiersz['godzina_z'];
					$_SESSION['cena_w3'] = $wiersz['cena_w'];
					$_SESSION['obraz3'] = $wiersz['obraz'];
					
				}
				else if(isset($_POST['holenderska']))
				{
					$pozycja1 = $polaczenie->query("SELECT * FROM holenderska ORDER BY id DESC LIMIT 1");
					$wiersz = $pozycja1->fetch_assoc();
					$_SESSION['nazwa1'] = $wiersz['nazwa'];
					$_SESSION['opis1'] = $wiersz['opis'];
					$_SESSION['data_r1'] = $wiersz['data_r'];
					$_SESSION['godzina_r1'] = $wiersz['godzina_r'];
					$_SESSION['data_z1'] = $wiersz['data_z'];
					$_SESSION['godzina_z1'] = $wiersz['godzina_z'];
					$_SESSION['cena_w1'] = $wiersz['cena_w'];
					$_SESSION['obraz1'] = $wiersz['obraz'];
					
					$pozycja2 = $polaczenie->query("SELECT * FROM holenderska ORDER BY id DESC LIMIT 1,1");
					$wiersz = $pozycja2->fetch_assoc();
					$_SESSION['nazwa2'] = $wiersz['nazwa'];
					$_SESSION['opis2'] = $wiersz['opis'];
					$_SESSION['data_r2'] = $wiersz['data_r'];
					$_SESSION['godzina_r2'] = $wiersz['godzina_r'];
					$_SESSION['data_z2'] = $wiersz['data_z'];
					$_SESSION['godzina_z2'] = $wiersz['godzina_z'];
					$_SESSION['cena_w2'] = $wiersz['cena_w'];
					$_SESSION['obraz2'] = $wiersz['obraz'];
					
					$pozycja3 = $polaczenie->query("SELECT * FROM holenderska ORDER BY id DESC LIMIT 2,1");
					$wiersz = $pozycja3->fetch_assoc();
					$_SESSION['nazwa3'] = $wiersz['nazwa'];
					$_SESSION['opis3'] = $wiersz['opis'];
					$_SESSION['data_r3'] = $wiersz['data_r'];
					$_SESSION['godzina_r3'] = $wiersz['godzina_r'];
					$_SESSION['data_z3'] = $wiersz['data_z'];
					$_SESSION['godzina_z3'] = $wiersz['godzina_z'];
					$_SESSION['cena_w3'] = $wiersz['cena_w'];
					$_SESSION['obraz3'] = $wiersz['obraz'];
					
					$aktualizacja_hol = $polaczenie->query("SELECT data_r,godzina_r,cena_w,spadek,czas_s FROM holenderska ");
					$tab_akt = $aktualizacja_hol->fetch_assoc();
					$data_r = $tab_akt['data_r'];
					$godzina_r = $tab_akt['godzina_r'];
					$cena_w = $tab_akt['cena_w'];
					$spadek = $tab_akt['spadek'];
					$czas_s = $tab_akt['czas_s'];
					
					$data_aktualna = Date('Y-m-d H:i:s');
					$liczba_sekund_dla_poczatku_aukcji = StrToTime($data_r);
					$liczba_sekund_dla_aktualnej_daty = StrToTime($data_aktualna);
					$liczba_sekund_dla_spadku = StrToTime($czas_s);
					
				    $roznica_czasu = $liczba_sekund_dla_poczatku_aukcji - $liczba_sekund_dla_aktualnej_daty;
					$liczba_spadkow = Floor($roznica_czasu/$liczba_sekund_dla_spadku);
					$roznica_ceny = $liczba_spadkow*$spadek;
					$nowa_cena = $cena_w - $roznica_ceny;
					echo $data_aktualna;
					
					
					
				}
			}
				
				$polaczenie->close();
			}
			
		
		catch(Exception $e)
		{
			echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o skorzystanie z usługi w innym terminie!</span>';
			echo '<br />Informacja developerska: '.$e;
		}
		
	
	
?>
<div class='naglowek'>
	<form action="logowanie.php" method="post">
	
		Login: <input type="text" name="nazwa" /> 
		Hasło: <input type="password" name="haslo" /> 
		<input type="submit" value="Zaloguj się" />

	</form>
	
			<br><br><br>
	
<form action="" method="post">
<input type="radio" name="klasyczna" value="klasyczna"/>Aukcja klasyczna 
<input type="radio" name="min" value="min"/>Aukcja z ceną minimalną
<input type="radio" name="holenderska" value="holenderska"/>Aukcja holenderska
	<input type="submit" value="szukaj"/>
</form>
	
<?php
	if(isset($_SESSION['blad']))	echo $_SESSION['blad'];
?>
<br>
Nie masz konta?  <a href="rejestracja.php"><b>Zarejestruj się!</b></a>
</div>

<div class='tresc'>
<div class="kwadrat1"> 
<?php
	
		echo 	$_SESSION['nazwa1'];
		echo 	$_SESSION['opis1'];
		echo 	$_SESSION['data_r1'];
		echo 	$_SESSION['godzina_r1'];
		echo 	$_SESSION['data_z1'];
		echo 	$_SESSION['godzina_z1'];
		echo 	$_SESSION['cena_w1'];
		$obraz = $_SESSION['obraz1'];
		echo 	"<img src= obrazy\'$obraz' />";

?>
</div>
<div class="kwadrat2">
<?php
		echo 	$_SESSION['nazwa2'];
		echo 	$_SESSION['opis2'];
		echo 	$_SESSION['data_r2'];
		echo 	$_SESSION['godzina_r2'];
		echo 	$_SESSION['data_z2'];
		echo 	$_SESSION['godzina_z2'];
		echo 	$_SESSION['cena_w2'];
		$obraz = $_SESSION['obraz2'];
		echo 	"<img src= obrazy\'$obraz' />";
?>
</div>
<div class="kwadrat3">
<?php
		echo 	$_SESSION['nazwa3'];
		echo 	$_SESSION['opis3'];
		echo 	$_SESSION['data_r3'];
		echo 	$_SESSION['godzina_r3'];
		echo 	$_SESSION['data_z3'];
		echo 	$_SESSION['godzina_z3'];
		echo 	$_SESSION['cena_w3'];
		$obraz = $_SESSION['obraz3'];
		echo 	"<img src= obrazy\'$obraz' />";
?>
</div>
</div>

<div class='stopka'>
stopka
</div>
	
</body>
</html>