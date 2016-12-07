<meta charset="UTF-8">
<?php
session_start();
require_once "connect.php";
		mysqli_report(MYSQLI_REPORT_STRICT);
		$imie = $_SESSION['imie'];
		try 
		{
			$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
			if ($polaczenie->connect_errno!=0)
			{
				throw new Exception(mysqli_connect_errno());
			}
			else
			{	
		
					$licz = $polaczenie->query("SELECT id FROM poczta ORDER BY id DESC LIMIT 1 ");
					$liczba_wierszy = $licz->fetch_assoc();
					$i = $liczba_wierszy['id'];
					$limit = 0;
					$_SESSION['i'] = $i;

					while($i>0)
					{
						
						$h = $polaczenie->query("SELECT id FROM poczta ORDER BY id DESC LIMIT 1 ");
						$k = $h->fetch_assoc();
						$id = $k['id'];
						$id = $id-$limit;
						$pozycja = $polaczenie->query("SELECT * FROM poczta WHERE id = '$id' AND adresat = '$imie' ");
						$wiersz = $pozycja->fetch_assoc();
						$_SESSION['nadawca'] = $wiersz['nadawca'];
						$_SESSION['tresc'] = $wiersz['tresc'];
						$_SESSION['data'] = $wiersz['data'];
						$limit++;
						$i--;
						
						
						if($_SESSION['tresc'] != ''){
						echo '<b>Nadawca : '.$_SESSION['nadawca'].'</b> data : '.$_SESSION['data'].'<br>';
						echo $_SESSION['tresc'].'<hr>';
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