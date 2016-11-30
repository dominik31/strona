<?php

session_start();
if ((!isset($_SESSION['zalogowany'])))
	{
		header('Location: index.php');
		exit();
	}
?>

<?php

function sprawdz_bledy()
{
  if ($_FILES['obrazek']['error'] > 0)
  {
    echo 'problem: ';
    switch ($_FILES['obrazek']['error'])
    {
      // jest wiêkszy ni¿ domyœlny maksymalny rozmiar,
      // podany w pliku konfiguracyjnym
      case 1: {echo 'Rozmiar pliku jest zbyt du¿y.'; break;} 
	  
      // jest wiêkszy ni¿ wartoœæ pola formularza 
      // MAX_FILE_SIZE
      case 2: {echo 'Rozmiar pliku jest zbyt du¿y.'; break;}
	  
      // plik nie zosta³ wys³any w ca³oœci
      case 3: {echo 'Plik wys³any tylko czêœciowo.'; break;}
	  
      // plik nie zosta³ wys³any
      case 4: {echo 'Nie wys³ano ¿adnego pliku.'; break;}
	  
      // pozosta³e b³êdy
      default: {echo 'Wyst¹pi³ b³¹d podczas wysy³ania.';
        break;}
    }
    return false;
  }
  return true;
}



function sprawdz_typ()
{
	if ($_FILES['obrazek']['type'] != 'image/jpeg')
		return false;
	return true;
}

function zapisz_plik()
{


  $len = 20;
  $r = substr(sha1(rand(1,10000)),0,$len);
  $_SESSION['r']=$r;
  
  $lokalizacja = "obrazy/'$r'.jpg";
	
  if(is_uploaded_file($_FILES['obrazek']['tmp_name']))
  {
    if(!move_uploaded_file($_FILES['obrazek']['tmp_name'], $lokalizacja))
    {
      echo 'problem: Nie uda³o siê skopiowaæ pliku do katalogu.';
        return false;  
    }
  }
  else
  {
    echo 'problem: Mo¿liwy atak podczas przesy³ania pliku.';
	echo 'Plik nie zosta³ zapisany.';
    return false;
  }
  return true;
}


if(isset($_POST['np']))
{
sprawdz_bledy();
sprawdz_typ();
zapisz_plik();


$np = $_POST['np'];
$opis = $_POST['opis'];
$data_r = $_POST['data_r'];
$data_z = $_POST['data_z'];
$cena_w = $_POST['cena_w'];
$spadek = $_POST['spadek'];
$czas_s = $_POST['czas_s'];
$dolna_granica = $_POST['dolna_granica'];
$obraz = $_SESSION['r'];
$user_w = $_SESSION['user'];


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
				
				$rezultat = $polaczenie->query("SELECT id FROM holenderska WHERE obraz='$obraz'");
				
				if (!$rezultat) throw new Exception($polaczenie->error);
				
				$ile_takich_obrazow = $rezultat->num_rows;
				if($ile_takich_obrazow>0)
				{
					$wszystko_OK=false;
					$_SESSION['e_obraz']="Nie uda³o siê, spróbuj dodaæ przedmiot jeszcze raz!";
				}		
				
				if ($wszystko_OK==true)
				{
					
					
					if ($polaczenie->query("INSERT INTO holenderska (nazwa,opis,data_r,data_z,cena_w,cena_a,dolna_granica,spadek,czas_s,obraz,user_w) VALUES ('$np', '$opis', '$data_r', '$data_z', '$cena_w','$cena_w', '$dolna_granica', '$spadek', '$czas_s', '$obraz', '$user_w' )"))
					{
						echo 'Uda³o siê dodaæ aukcjê z holendersk¹!';
					}
					else
					{
						throw new Exception($polaczenie->error);
					}
					
				}
				
				$polaczenie->close();
			}
			
		}
		catch(Exception $e)
		{
			echo '<span style="color:red;">B³¹d serwera! Przepraszamy za niedogodnoœci i prosimy o skorzystanie z us³ugi w innym terminie!</span>';
			echo '<br />Informacja developerska: '.$e;
		}
		
	
}
?>

<html lang="pl">
<head>
<meta charset="utf-8" />
</head>
<br><br><br><br>
<div>

<form action="" method="post" name="klas" enctype="multipart/form-data">

NAZWA PRZEDMIOTU : <input type="text" name="np" required /><br>
KRÓTKI OPIS (max 300 liter) :<input type="text" name="opis" /> <br>
DATA I GODZINA ROZPOCZÊCIA AUKCJI : <input type="datetime-local" name="data_r"required /><br>
DATA I GODZINA ZAKOÑCZENIA AUKCJI : <input type="datetime-local" name="data_z"required /><br>
CENA WYWO£AWCZA : <input type="number" name="cena_w" min="0"/><br>
CENA SPADA O : <input type="number" name="spadek" min="0" required/>Z£  CO : <input type="time" name="czas_s" required/><br>
PROSZÊ USTALIÆ DOLN¥ GRANICÊ (cena nie spadnie poni¿ej tej granicy) : <input type="number" name="dolna_granica" min="0" required/>
<br>
PROSZÊ WSTAWIÆ ZDIÊCIE PRZEDMIOTU :
<input type="hidden" name="MAX_FILE_SIZE" value="512000" />
<input type="file" name="obrazek" required />
<input type="submit" value="wyœlij" />
</form>
<hr><hr>
<form action="nowa_aukcja.php" method="post"><input type="submit" value="WRÓÆ"></form><br>
<form action="strona_usera.php" method="post"><input type="submit" value="MOJA STRONA"></form>
</div>

</html>