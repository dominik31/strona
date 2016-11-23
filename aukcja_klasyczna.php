<?php

session_start();
if ((!isset($_SESSION['zalogowany'])))
	{
		header('Location: index.php');
		exit();
	}


function sprawdz_bledy()
{
  if ($_FILES['obrazek']['error'] > 0)
  {
    echo 'problem: ';
    switch ($_FILES['obrazek']['error'])
    {
      // jest większy niż domyślny maksymalny rozmiar,
      // podany w pliku konfiguracyjnym
      case 1: {echo 'Rozmiar pliku jest zbyt duży.'; break;} 
	  
      // jest większy niż wartość pola formularza 
      // MAX_FILE_SIZE
      case 2: {echo 'Rozmiar pliku jest zbyt duży.'; break;}
	  
      // plik nie został wysłany w całości
      case 3: {echo 'Plik wysłany tylko częściowo.'; break;}
	  
      // plik nie został wysłany
      case 4: {echo 'Nie wysłano żadnego pliku.'; break;}
	  
      // pozostałe błędy
      default: {echo 'Wystąpił błąd podczas wysyłania.';
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
      echo 'problem: Nie udało się skopiować pliku do katalogu.';
        return false;  
    }
  }
  else
  {
    echo 'problem: Możliwy atak podczas przesyłania pliku.';
	echo 'Plik nie został zapisany.';
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
				
				$rezultat = $polaczenie->query("SELECT id FROM klasyczna WHERE obraz='$obraz'");
				
				if (!$rezultat) throw new Exception($polaczenie->error);
				
				$ile_takich_obrazow = $rezultat->num_rows;
				if($ile_takich_obrazow>0)
				{
					$wszystko_OK=false;
					$_SESSION['e_obraz']="Nie udało się, spróbuj dodać przedmiot jeszcze raz!";
				}		
				
				if ($wszystko_OK==true)
				{
					
					
					if ($polaczenie->query("INSERT INTO klasyczna (nazwa,opis,data_r,data_z,cena_w,obraz,user_w) VALUES ('$np', '$opis', '$data_r', '$data_z', '$cena_w', '$obraz','$user_w' )"))
					{
						echo 'Udało się dodać aukcję klasyczną!';
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
			echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o skorzystanie z usługi w innym terminie!</span>';
			echo '<br />Informacja developerska: '.$e;
		}
		
	
}
?>

<html>
<br><br><br><br>
<div>

<form action="" method="post" name="klas" enctype="multipart/form-data">

NAZWA PRZEDMIOTU : <input type="text" name="np" required /><br>
KRÓTKI OPIS (max 300 liter) :<input type="text" name="opis" /> <br>
DATA I GODZINA ROZPOCZĘCIA AUKCJI : <input type="datetime-local" name="data_r"required /><br>
DATA I GODZINA ZAKOŃCZENIA AUKCJI : <input type="datetime-local" name="data_z"required /><br>
CENA WYWOŁAWCZA : <input type="number" name="cena_w" min="0" /><br>
<br>
PROSZĘ WSTAWIĆ ZDIĘCIE PRZEDMIOTU :
<input type="hidden" name="MAX_FILE_SIZE" value="512000" />
<input type="file" name="obrazek" required />
<input type="submit" value="wyślij" />
</form>

</div>

</html>