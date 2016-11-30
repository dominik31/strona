<html>
<a href="index.php">Wróć</a><br/>
<?php

session_start();

if ((!isset($_SESSION['zalogowany'])))
	{
		header('Location: index.php');
		$_SESSION['bl'] = '<span style="color:red;"><center><hr>Musisz być zalogowany aby wziąć udział w licytacji!<hr></center></span>';
		exit();
	}

$nazwa = $_SESSION['user'];
$email = $_SESSION['email'];

echo $nazwa.'<br>'.$email.'<br><hr>';
echo '<hr>';

if(isset($_POST['nr']))
{
	echo 'Aukcja nr.: '.$_POST['nr'];
	$nr = $_POST['nr'];
	$_SESSION['nr'] = $nr;
}
if(isset($_SESSION['klasyczna']))
{
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

					if(isset($_POST['cena_n'])) $cena_n = $_POST['cena_n'];
					$nr = $_SESSION['nr'];
					
					$wypisz = $polaczenie->query("SELECT * FROM klasyczna WHERE id = '$nr' ");
					$wyp_t = $wypisz->fetch_assoc();
					$nazwa = $wyp_t['nazwa'];
					$opis = $wyp_t['opis'];
					$data_r = $wyp_t['data_r'];
					$data_z = $wyp_t['data_z'];
					$obraz = $wyp_t['obraz'];
					$cena = $wyp_t['cena_w'];
					
										echo 	'<p>'.'Nazwa : '.$nazwa.'<br/>';
										echo 	'Opis: '.$opis.'<br/>';
										echo 	'Data rozpoczęcia aukcji: '.$data_r.'<br/>';
										echo 	'Data zakończenia aukcji: '.$data_z.'<br/>';
										echo 	'Cena: '.$cena.'  zł'.'<br/>';
										echo 	"<img src= obrazy\'$obraz' />".'<br/>';
			
					echo '<form action="" method="post">';
					echo 'Przebij cenę: '.'<input type="number" name="cena_n" min="0" size="3"/>';
					echo '<input type="submit" value="POTWIERDŹ"/>';
					echo '</form>';
					
					$user_k = $_SESSION['user'];
					
					if(isset($_POST['cena_n']))
				{		
						
						
						$spr = $polaczenie->query("SELECT cena_w FROM klasyczna WHERE id = '$nr' ");
						$tab = $spr->fetch_assoc();
						$cena_w = $tab['cena_w'];
						
						
						if($cena_w>$cena_n) 
						{
							echo '<span style="color:red;">Nowa cena musi być wyższa od starej!</span>';
							
						}
						else if($aktualizacja = $polaczenie->query("UPDATE klasyczna SET cena_w = '$cena_n', user_k = '$user_k' WHERE id = '$nr' "))
						{
							echo 'Udało się przebić cenę!';
							
							echo 'Obecnie aukcje wygrywa '.$user_k;
						}
						else
						{
							echo 'Wystapił błąd, proszę spróbować jeszcze raz.';
						}
						header('refresh: 4;');
				}
			}
			
		}
			catch(Exception $e)
			{
				echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o skorzystanie z usługi w innym terminie!</span>';
				echo '<br />Informacja developerska: '.$e;
			}
		
}
else if(isset($_SESSION['min']))
{
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

					if(isset($_POST['cena_n'])) $cena_n = $_POST['cena_n'];
					$nr = $_SESSION['nr'];

					$wypisz = $polaczenie->query("SELECT * FROM min WHERE id = '$nr' ");
					$wyp_t = $wypisz->fetch_assoc();
					$nazwa = $wyp_t['nazwa'];
					$opis = $wyp_t['opis'];
					$data_r = $wyp_t['data_r'];
					$data_z = $wyp_t['data_z'];
					$obraz = $wyp_t['obraz'];
					$cena = $wyp_t['cena_w'];
					$cena_m = $wyp_t['cena_m'];
					
										echo 	'<p>'.'Nazwa : '.$nazwa.'<br/>';
										echo 	'Opis: '.$opis.'<br/>';
										echo 	'Data rozpoczęcia aukcji: '.$data_r.'<br/>';
										echo 	'Data zakończenia aukcji: '.$data_z.'<br/>';
										echo 	'Cena: '.$cena.'  zł'.'<br/>';
										echo 	'Cena minimalna: '.$cena_m.'  zł'.'<br/>';
										echo 	"<img src= obrazy\'$obraz' />".'<br/>';
			
					echo '<form action="" method="post">';
					echo 'Przebij cenę: '.'<input type="number" name="cena_n" min="0" size="3"/>';
					echo '<input type="submit" value="POTWIERDŹ"/>';
					echo '</form>';
					
					$user_k = $_SESSION['user'];
					
					if(isset($_POST['cena_n']))
					{		
						
						
						$spr = $polaczenie->query("SELECT cena_w FROM min WHERE id = '$nr' ");
						$tab = $spr->fetch_assoc();
						$cena_w = $tab['cena_w'];
						
						
						if($cena_w>$cena_n) 
						{
							echo '<span style="color:red;">Nowa cena musi być wyższa od starej!</span>';
							
						}
						else if($aktualizacja = $polaczenie->query("UPDATE min SET cena_w = '$cena_n', user_k = '$user_k' WHERE id = '$nr' "))
						{
							echo 'Udało się przebić cenę!';
							echo 'Obecnie aukcje wygrywa '.$user_k.'<br/>';
							if($cena_n>$cena_m) echo '<span style="color:green">Przebiłeś cenę minimalną!</span>';
							
						}
						else
						{
							echo 'Wystapił błąd, proszę spróbować jeszcze raz.';
						}
						
						header('refresh: 4;');
					}
			}
			
		}
			catch(Exception $e)
			{
				echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o skorzystanie z usługi w innym terminie!</span>';
				echo '<br />Informacja developerska: '.$e;
			}
}
else if(isset($_SESSION['holenderska']))
{
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

					if(isset($_POST['cena_n'])) $cena_n = $_POST['cena_n'];
					$nr = $_SESSION['nr'];
					
					$wypisz = $polaczenie->query("SELECT * FROM holenderska WHERE id = '$nr' ");
					$wyp_t = $wypisz->fetch_assoc();
					$nazwa = $wyp_t['nazwa'];
					$opis = $wyp_t['opis'];
					$data_r = $wyp_t['data_r'];
					$data_z = $wyp_t['data_z'];
					$cena_a = $wyp_t['cena_a'];
					$spadek = $wyp_t['spadek'];
					$czas_s = $wyp_t['czas_s'];
					$obraz = $wyp_t['obraz'];
					$cena = $wyp_t['cena_w'];
					$dolna_granica = $wyp_t['dolna_granica'];

					
										echo 	'<p>'.'Nazwa : '.$nazwa.'<br/>';
										echo 	'Opis: '.$opis.'<br/>';
										echo 	'Data rozpoczęcia aukcji: '.$data_r.'<br/>';
										echo 	'Data zakończenia aukcji: '.$data_z.'<br/>';
										echo 	'Cena wywoławcza : '.$cena.'  zł'.'<br/>';
										echo    '<span style="color:green"><b>Cena aktualna : '.$cena_a.' zł </b></span><br/>';
										echo    'Cena spada o : '.$spadek.' co '.$czas_s.'<br/>';
										echo 	"<img src= obrazy\'$obraz' />".'<br/>';
					$_SESSION['cena_a'] = $cena_a;
					echo '<form action="" method="post" name="cena_n">';
					echo 'Akceptuj  aktualną cenę: '.'<input type="text" name="cena_n" value="'.$_SESSION['cena_a'].'" readonly="readonly" size="1"/>';
					echo '<input type="submit" value="POTWIERDŹ"/>';
					echo '</form>';
					
					$user_k = $_SESSION['user'];
					
					if(isset($_POST['cena_n']))
				{		
						
					if($dolna_granica<$cena_a)
					{

						 if($aktualizacja = $polaczenie->query("UPDATE holenderska SET user_k = '$user_k' WHERE id = '$nr' "))
						{

							echo '<span style="color:blue"><b>Aukcje wygrywa :  '.$user_k.'!</b></span>';
						}
						else
						{
							echo 'Wystapił błąd, proszę spróbować jeszcze raz.';
						}
						header('refresh: 5;');
					}
				}
			}
			
		}
			catch(Exception $e)
			{
				echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o skorzystanie z usługi w innym terminie!</span>';
				echo '<br />Informacja developerska: '.$e;
			}
}

?>




</html>