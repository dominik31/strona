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

	
?>
<div class='naglowek'>
	<form action="logowanie.php" method="post">
	
		Login: <input type="text" name="nazwa" /> 
		Hasło: <input type="password" name="haslo" /> 
		<input type="submit" value="Zaloguj się" />

	</form>
	
			
			

	
<form action="" method="post">
<input type="radio" name="klasyczna" value="klasyczna"/>Aukcja klasyczna 
<input type="radio" name="min" value="min"/>Aukcja z ceną minimalną
<input type="radio" name="holenderska" value="holenderska"/>Aukcja holenderska
	<input type="submit" value="szukaj"/>
</form>
	Nie masz konta?  <a href="rejestracja.php"><b>Zarejestruj się!</b></a>


<?php
	if(isset($_SESSION['blad']))	echo $_SESSION['blad'];
	if(isset($_SESSION['bl'])) echo '<br/>'.$_SESSION['bl'];
?>
</div>

<div class='tresc'>
<?php

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
					
					$licz = $polaczenie->query("SELECT * FROM klasyczna ");
					$liczba_wierszy = $licz->num_rows;
					$i = $liczba_wierszy;
					$limit = 0;
					$_SESSION['i'] = $i;

					while($i>0)
					{
						
						$_SESSION['klasyczna'] = TRUE;
						$h = $polaczenie->query("SELECT id FROM klasyczna  ORDER BY id DESC LIMIT 1 ");
						$k = $h->fetch_assoc();
						$id = $k['id'];
						$id = $id-$limit;
						$pozycja = $polaczenie->query("SELECT * FROM klasyczna WHERE id = '$id' ");
						$wiersz = $pozycja->fetch_assoc();
						$_SESSION['nr'] = $wiersz['id'];
						$_SESSION['nazwa'] = $wiersz['nazwa'];
						$_SESSION['opis'] = $wiersz['opis'];
						$_SESSION['data_r'] = $wiersz['data_r'];
						$_SESSION['data_z'] = $wiersz['data_z'];
						$_SESSION['cena_w'] = $wiersz['cena_w'];
						$_SESSION['obraz'] = $wiersz['obraz'];
						$limit++;
						$i--;
						
						
									echo 	'<p>'.'Nazwa : '.$_SESSION['nazwa'].'<br/>';
									echo 	'Opis: '.$_SESSION['opis'].'<br/>';
									echo 	'Data rozpoczęcia aukcji: '.$_SESSION['data_r'].'<br/>';
									echo 	'Data zakończenia aukcji: '.$_SESSION['data_z'].'<br/>';
									echo 	'Cena: '.$_SESSION['cena_w'].'<br/>';
									$obraz = $_SESSION['obraz'];
									echo 	"<img src= obrazy\'$obraz' />".'<br/>';
									echo'<form action="licytacja" method="post" >';
									echo 'Numer tej aukcji: '.'<input type="text" name="nr" value="'.$_SESSION['nr'].'" readonly="readonly" size="1"/>'.'<br/>';
									echo'<input type="submit" value="LICYTUJ"/>';
									echo'</form>'.'</p>';
									echo '<hr/>';
					}
					
				}
				else if(isset($_POST['min']))
				{
					$licz = $polaczenie->query("SELECT * FROM min ");
					$liczba_wierszy = $licz->num_rows;
					$i = $liczba_wierszy;
					$limit = 0;
					$_SESSION['i'] = $i;

					while($i>0)
					{
						
						$_SESSION['min'] = TRUE;
						$h = $polaczenie->query("SELECT id FROM min  ORDER BY id DESC LIMIT 1 ");
						$k = $h->fetch_assoc();
						$id = $k['id'];
						$id = $id-$limit;
						$pozycja = $polaczenie->query("SELECT * FROM min WHERE id = '$id' ");
						$wiersz = $pozycja->fetch_assoc();
						$_SESSION['nr'] = $wiersz['id'];
						$_SESSION['nazwa'] = $wiersz['nazwa'];
						$_SESSION['opis'] = $wiersz['opis'];
						$_SESSION['data_r'] = $wiersz['data_r'];
						$_SESSION['data_z'] = $wiersz['data_z'];
						$_SESSION['cena_w'] = $wiersz['cena_w'];
						$_SESSION['cena_m'] = $wiersz['cena_m'];
						$_SESSION['obraz'] = $wiersz['obraz'];
						$limit++;
						$i--;
						
						
									echo 	'<p>'.'Nazwa : '.$_SESSION['nazwa'].'<br/>';
									echo 	'Opis: '.$_SESSION['opis'].'<br/>';
									echo 	'Data rozpoczęcia aukcji: '.$_SESSION['data_r'].'<br/>';
									echo 	'Data zakończenia aukcji: '.$_SESSION['data_z'].'<br/>';
									echo 	'Cena: '.$_SESSION['cena_w'].'<br/>';
									echo 	'Cena minimalna: '.$_SESSION['cena_m'].'<br/>';
									$obraz = $_SESSION['obraz'];
									echo 	"<img src= obrazy\'$obraz' />".'<br/>';
									echo'<form action="licytacja" method="post" >';
									echo 'Numer tej aukcji: '.'<input type="text" name="nr" value="'.$_SESSION['nr'].'" readonly="readonly" size="1"/>'.'<br/>';
									echo'<input type="submit" value="LICYTUJ"/>';
									echo'</form>'.'</p>';
									echo '<hr/>';
								
					}
					
				}
				else if(isset($_POST['holenderska']))
				{
					$licz = $polaczenie->query("SELECT * FROM holenderska ");
					$liczba_wierszy = $licz->num_rows;
					$i = $liczba_wierszy;
					$limit = 0;
					$_SESSION['i'] = $i;

					while($i>0)
					{
						
						$_SESSION['holenderska'] = TRUE;
						$h = $polaczenie->query("SELECT id FROM holenderska  ORDER BY id DESC LIMIT 1 ");
						$k = $h->fetch_assoc();
						$id = $k['id'];
						$id = $id-$limit;
						$pozycja = $polaczenie->query("SELECT * FROM holenderska WHERE id = '$id' ");
						$wiersz = $pozycja->fetch_assoc();
						$_SESSION['nr'] = $wiersz['id'];
						$_SESSION['nazwa'] = $wiersz['nazwa'];
						$_SESSION['opis'] = $wiersz['opis'];
						$_SESSION['data_r'] = $wiersz['data_r'];
						$_SESSION['data_z'] = $wiersz['data_z'];
						$_SESSION['cena_w'] = $wiersz['cena_w'];
						$_SESSION['spadek'] = $wiersz['spadek'];
						$_SESSION['czas_s'] = $wiersz['czas_s'];
						$_SESSION['obraz'] = $wiersz['obraz'];
						$limit++;
						$i--;
						
						
									echo 	'<p>'.'Nazwa : '.$_SESSION['nazwa'].'<br/>';
									echo 	'Opis: '.$_SESSION['opis'].'<br/>';
									echo 	'Data rozpoczęcia aukcji: '.$_SESSION['data_r'].'<br/>';
									echo 	'Data zakończenia aukcji: '.$_SESSION['data_z'].'<br/>';
									echo 	'Cena: '.$_SESSION['cena_w'].'<br/>';
									echo 	'Cena spada o: '.$_SESSION['spadek'].'<br/>';
									echo 	'Cena spada co: '.$_SESSION['czas_s'].'<br/>';
									$obraz = $_SESSION['obraz'];
									echo 	"<img src= obrazy\'$obraz' />".'<br/>';
									echo'<form action="licytacja" method="post" >';
									echo 'Numer tej aukcji: '.'<input name="nr" type="text" value="'.$_SESSION['nr'].'" readonly="readonly" size="1"/>'.'<br/>';
									echo'<input type="submit" value="LICYTUJ"/>';
									echo'</form>'.'</p>';
									echo '<hr/>';
					}
									
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

</div>
	
</body>
</html>
