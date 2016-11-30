<?php

if(isset($_POST['klasyczna']))
				{
					
					$licz = $polaczenie->query("SELECT * FROM klasyczna WHERE user_w = '$imie' ");
					$liczba_wierszy = $licz->num_rows;
					$i = $liczba_wierszy;
					$limit = 0;
					$_SESSION['i'] = $i;

					while($i>0)
					{
						
						$_SESSION['klasyczna'] = TRUE;
						$h = $polaczenie->query("SELECT id FROM klasyczna WHERE user_w = '$imie' ORDER BY id DESC LIMIT 1 ");
						$k = $h->fetch_assoc();
						$id = $k['id'];
						$id = $id-$limit;
						$pozycja = $polaczenie->query("SELECT * FROM klasyczna WHERE id = '$id' AND user_w = '$imie' ");
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
				if(isset($_POST['min']))
				{
					$licz = $polaczenie->query("SELECT * FROM min  WHERE user_w = '$imie'");
					$liczba_wierszy = $licz->num_rows;
					$i = $liczba_wierszy;
					$limit = 0;
					$_SESSION['i'] = $i;

					while($i>0)
					{
						
						$_SESSION['min'] = TRUE;
						$h = $polaczenie->query("SELECT id FROM min WHERE user_w = '$imie' ORDER BY id DESC LIMIT 1 ");
						$k = $h->fetch_assoc();
						$id = $k['id'];
						$id = $id-$limit;
						$pozycja = $polaczenie->query("SELECT * FROM min WHERE id = '$id' AND user_w = '$imie' ");
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
				if(isset($_POST['holenderska']))
				{
					$licz = $polaczenie->query("SELECT * FROM holenderska WHERE user_w = '$imie' ");
					$liczba_wierszy = $licz->num_rows;
					$i = $liczba_wierszy;
					$limit = 0;
					$_SESSION['i'] = $i;

					while($i>0)
					{
						
						$_SESSION['holenderska'] = TRUE;
						$h = $polaczenie->query("SELECT id FROM holenderska WHERE user_w = '$imie' ORDER BY id DESC LIMIT 1 ");
						$k = $h->fetch_assoc();
						$id = $k['id'];
						$id = $id-$limit;
						$pozycja = $polaczenie->query("SELECT * FROM holenderska WHERE id = '$id' AND user_w = '$imie' ");
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

?>