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

?>