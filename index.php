<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta charset="UTF-8">
<title>Strona aukcyjna</title>

<link rel="stylesheet" type="text/css" href="css/main.css" />
 
</head>
<?php

session_start();

	if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
	{
		header('Location: strona_usera.php');
		exit();
	}

	require_once "kontrola.php";
?>
<body>

	<div id="container">

        <div id="header_logo">
        	<a href="#"><img src="images/logo.jpg" alt="Logo" /></a>
        </div>
        <div id="header_left_top_info">
        <p>Aby uczestniczyæ w aukcjach a tak¿e samemu wystawiaæ przedmioty zaloguj siê</p>
        </div>
        <div id="header_menu">
<b><center><h1>Strona aukcyjna za darmo<h1></center></b>
        </div>
	<div id="header_main">
    <div id="header_main_image"></div>
    	<div id="header_main_text">
        	<h2>Zaloguj siê</h2>
            <p>
	<form action="logowanie.php" method="post">
		Login: <input type="text" name="nazwa" /> <br/>
		Has³o: <input type="password" name="haslo" />  <br/>
		<input type="submit" value="Zaloguj siê" />
	</form>
	<?php
	if(isset($_SESSION['blad'])){
	echo $_SESSION['blad'];
unset($_SESSION['blad']);}
	if(isset($_SESSION['bl'])) {echo '<br/>'.$_SESSION['bl'];
	
	unset($_SESSION['bl']);}
	
?>
		Nie masz konta?  <a href="rejestracja.php"><b>Zarejestruj siê!</b></a>
            </p>
	</div>
    <div id="boxy">
    		<div id="boxy_text_1">
        	<h2>Trzy rodzaje aukcji!</h2>
            <span>
            Dla klientów udostêpniamy trzy rodzaje aukcji!
            </span>
            </div>
			<form action="" method="post">
            <div id="boxy_images">
            
         <input type="radio" name="klasyczna" value="klasyczna"/><img src="images/cat_b.jpg" />
            
          <input type="radio" name="min" value="min"/><img src="images/cat_d.jpg" />
           
          <input type="radio" name="holenderska" value="holenderska"/><img src="images/cat_ce.jpg" /><br>
		  <input type="submit" value="szukaj"/>
			</form>
            </div>

    </div>    
    <div id="boxy_content">
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
					
					$licz = $polaczenie->query("SELECT id FROM klasyczna ORDER BY id DESC  ");
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
						$_SESSION['user_w'] = $wiersz['user_w'];
						$limit++;
						$i--;
						

echo '<div id="boxy_content">';
 echo   '	<div id="boxy_content_lx">';
 echo       '	<h2>Oferta</h2>';
        echo    '<p>';
									echo 	'<p>'.'Nazwa : '.$_SESSION['nazwa'].'<br/>';
									echo 	'Opis: '.$_SESSION['opis'].'<br/>';
									echo 	'Data rozpoczÄ™cia aukcji: '.$_SESSION['data_r'].'<br/>';
									echo 	'Data zakoÅ„czenia aukcji: '.$_SESSION['data_z'].'<br/>';
									echo 	'Cena: '.$_SESSION['cena_w'].'<br/>';
									echo 	'W³a¶ciciel: '.$_SESSION['user_w'].'<br/>';
									$obraz = $_SESSION['obraz'];
									echo 	"<img src= obrazy/'$obraz'.jpg />".'<br/>';

									echo '<hr/>';
        echo   ' </p>';
       echo '</div>';
    echo'	<div id="boxy_content_lx" class="margin_l40">';
 echo       '	<h2>Oferta</h2>';
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
						$_SESSION['user_w'] = $wiersz['user_w'];
						$_SESSION['obraz'] = $wiersz['obraz'];
						$limit++;
						$i--;
         echo  ' <p>';
									echo 	'<p>'.'Nazwa : '.$_SESSION['nazwa'].'<br/>';
									echo 	'Opis: '.$_SESSION['opis'].'<br/>';
									echo 	'Data rozpoczÄ™cia aukcji: '.$_SESSION['data_r'].'<br/>';
									echo 	'Data zakoÅ„czenia aukcji: '.$_SESSION['data_z'].'<br/>';
									echo 	'Cena: '.$_SESSION['cena_w'].'<br/>';
									echo 	'W³a¶ciciel: '.$_SESSION['user_w'].'<br/>';
									$obraz = $_SESSION['obraz'];
									echo 	"<img src= obrazy/'$obraz'.jpg />".'<br/>';

									echo '<hr/>';
        echo   ' </p>';
      echo ' </div>';
   echo 	'<div id="boxy_content_lx" class="margin_l40">';
 echo       '	<h2>Oferta</h2>';
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
						$_SESSION['user_w'] = $wiersz['user_w'];
						$_SESSION['obraz'] = $wiersz['obraz'];
						$limit++;
						$i--;
          echo  '<p>';
									echo 	'<p>'.'Nazwa : '.$_SESSION['nazwa'].'<br/>';
									echo 	'Opis: '.$_SESSION['opis'].'<br/>';
									echo 	'Data rozpoczÄ™cia aukcji: '.$_SESSION['data_r'].'<br/>';
									echo 	'Data zakoÅ„czenia aukcji: '.$_SESSION['data_z'].'<br/>';
									echo 	'Cena: '.$_SESSION['cena_w'].'<br/>';
									echo 	'W³a¶ciciel: '.$_SESSION['user_w'].'<br/>';
									$obraz = $_SESSION['obraz'];
									echo 	"<img src= obrazy/'$obraz'.jpg />".'<br/>';

									echo '<hr/>';
          echo ' </p>';
       echo '</div>';
   echo'</div>';
						

					}
					
				}
				else if(isset($_POST['min']))
				{
					$licz = $polaczenie->query("SELECT id FROM min ORDER BY id DESC  ");
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
						$_SESSION['user_w'] = $wiersz['user_w'];
						$_SESSION['obraz'] = $wiersz['obraz'];
						$limit++;
						$i--;
						
						
echo '<div id="boxy_content">';
 echo   '	<div id="boxy_content_lx">';
 echo       '	<h2>Oferta</h2>';
        echo    '<p>';
									echo 	'<p>'.'Nazwa : '.$_SESSION['nazwa'].'<br/>';
									echo 	'Opis: '.$_SESSION['opis'].'<br/>';
									echo 	'Data rozpoczÄ™cia aukcji: '.$_SESSION['data_r'].'<br/>';
									echo 	'Data zakoÅ„czenia aukcji: '.$_SESSION['data_z'].'<br/>';
									echo 	'Cena: '.$_SESSION['cena_w'].'<br/>';
									echo 	'Cena minimalna: '.$_SESSION['cena_m'].'<br/>';
									echo 	'W³a¶ciciel: '.$_SESSION['user_w'].'<br/>';
									$obraz = $_SESSION['obraz'];
									echo 	"<img src= obrazy/'$obraz'.jpg />".'<br/>';

									echo '<hr/>';
        echo   ' </p>';
       echo '</div>';
    echo'	<div id="boxy_content_lx" class="margin_l40">';
 echo       '	<h2>Oferta</h2>';
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
						$_SESSION['user_w'] = $wiersz['user_w'];
						$_SESSION['cena_m'] = $wiersz['cena_m'];
						$_SESSION['obraz'] = $wiersz['obraz'];
						$limit++;
						$i--;
         echo  ' <p>';
									echo 	'<p>'.'Nazwa : '.$_SESSION['nazwa'].'<br/>';
									echo 	'Opis: '.$_SESSION['opis'].'<br/>';
									echo 	'Data rozpoczÄ™cia aukcji: '.$_SESSION['data_r'].'<br/>';
									echo 	'Data zakoÅ„czenia aukcji: '.$_SESSION['data_z'].'<br/>';
									echo 	'Cena: '.$_SESSION['cena_w'].'<br/>';
									echo 	'Cena minimalna: '.$_SESSION['cena_m'].'<br/>';
									echo 	'W³a¶ciciel: '.$_SESSION['user_w'].'<br/>';
									$obraz = $_SESSION['obraz'];
									echo 	"<img src= obrazy/'$obraz'.jpg />".'<br/>';

									echo '<hr/>';
        echo   ' </p>';
      echo ' </div>';
   echo 	'<div id="boxy_content_lx" class="margin_l40">';
 echo       '	<h2>Oferta</h2>';
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
						$_SESSION['user_w'] = $wiersz['user_w'];
						$_SESSION['cena_m'] = $wiersz['cena_m'];
						$_SESSION['obraz'] = $wiersz['obraz'];
						$limit++;
						$i--;
          echo  '<p>';
									echo 	'<p>'.'Nazwa : '.$_SESSION['nazwa'].'<br/>';
									echo 	'Opis: '.$_SESSION['opis'].'<br/>';
									echo 	'Data rozpoczÄ™cia aukcji: '.$_SESSION['data_r'].'<br/>';
									echo 	'Data zakoÅ„czenia aukcji: '.$_SESSION['data_z'].'<br/>';
									echo 	'Cena: '.$_SESSION['cena_w'].'<br/>';
									echo 	'Cena minimalna: '.$_SESSION['cena_m'].'<br/>';
									echo 	'W³a¶ciciel: '.$_SESSION['user_w'].'<br/>';
									$obraz = $_SESSION['obraz'];
									echo 	"<img src= obrazy/'$obraz'.jpg />".'<br/>';

									echo '<hr/>';
          echo ' </p>';
       echo '</div>';
   echo'</div>';
								
					}
					
				}
				else if(isset($_POST['holenderska']))
				{
					
					$licz = $polaczenie->query("SELECT id FROM holenderska ORDER BY id DESC  ");
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
						$_SESSION['user_w'] = $wiersz['user_w'];
						$_SESSION['cena_a'] = $wiersz['cena_a'];
						$_SESSION['spadek'] = $wiersz['spadek'];
						$_SESSION['czas_s'] = $wiersz['czas_s'];
						$_SESSION['obraz'] = $wiersz['obraz'];
						$limit++;
						$i--;
						
						require('aktualizacja_holenderska.php');

						
echo '<div id="boxy_content">';
 echo   '	<div id="boxy_content_lx">';
 echo       '	<h2>Oferta</h2>';
        echo    '<p>';
									echo 	'<p>'.'Nazwa : '.$_SESSION['nazwa'].'<br/>';
									echo 	'Opis: '.$_SESSION['opis'].'<br/>';
									echo 	'Data rozpoczÄ™cia aukcji: '.$_SESSION['data_r'].'<br/>';
									echo 	'Data zakoÅ„czenia aukcji: '.$_SESSION['data_z'].'<br/>';
									echo 	'Cena wywoÅ‚awcza: '.$_SESSION['cena_w'].'<br/>';
									echo 	'<span style="color:green">Cena aktualna: '.$_SESSION['cena_a'].'<br/></span>';
									echo 	'Cena spada o: '.$_SESSION['spadek'].'<br/>';
									echo 	'W³a¶ciciel: '.$_SESSION['user_w'].'<br/>';
									echo 	'Cena spada co: '.$_SESSION['czas_s'].'<br/>';
									$obraz = $_SESSION['obraz'];
									echo 	"<img src= obrazy/'$obraz'.jpg />".'<br/>';
									echo'<form action="licytacja.php" method="post" >';
									echo 'Numer tej aukcji: '.'<input name="nr" type="text" value="'.$_SESSION['nr'].'" readonly="readonly" size="1"/>'.'<br/>';
									echo'<input type="submit" value="LICYTUJ"/>';
									echo'</form>'.'</p>';
									require_once('aktualizacja_holenderska.php');

									echo '<hr/>';
        echo   ' </p>';
       echo '</div>';
    echo'	<div id="boxy_content_lx" class="margin_l40">';
 echo       '	<h2>Oferta</h2>';
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
						$_SESSION['user_w'] = $wiersz['user_w'];
						$_SESSION['cena_a'] = $wiersz['cena_a'];
						$_SESSION['spadek'] = $wiersz['spadek'];
						$_SESSION['czas_s'] = $wiersz['czas_s'];
						$_SESSION['obraz'] = $wiersz['obraz'];
						$limit++;
						$i--;
         echo  ' <p>';
									echo 	'<p>'.'Nazwa : '.$_SESSION['nazwa'].'<br/>';
									echo 	'Opis: '.$_SESSION['opis'].'<br/>';
									echo 	'Data rozpoczÄ™cia aukcji: '.$_SESSION['data_r'].'<br/>';
									echo 	'Data zakoÅ„czenia aukcji: '.$_SESSION['data_z'].'<br/>';
									echo 	'Cena wywoÅ‚awcza: '.$_SESSION['cena_w'].'<br/>';
									echo 	'<span style="color:green">Cena aktualna: '.$_SESSION['cena_a'].'<br/></span>';
									echo 	'Cena spada o: '.$_SESSION['spadek'].'<br/>';
									echo 	'W³a¶ciciel: '.$_SESSION['user_w'].'<br/>';
									echo 	'Cena spada co: '.$_SESSION['czas_s'].'<br/>';
									$obraz = $_SESSION['obraz'];
									echo 	"<img src= obrazy/'$obraz'.jpg />".'<br/>';
									echo'<form action="licytacja.php" method="post" >';
									echo 'Numer tej aukcji: '.'<input name="nr" type="text" value="'.$_SESSION['nr'].'" readonly="readonly" size="1"/>'.'<br/>';
									echo'<input type="submit" value="LICYTUJ"/>';
									echo'</form>'.'</p>';
									require_once('aktualizacja_holenderska.php');

									echo '<hr/>';
        echo   ' </p>';
      echo ' </div>';
   echo 	'<div id="boxy_content_lx" class="margin_l40">';
 echo       '	<h2>Oferta</h2>';
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
						$_SESSION['user_w'] = $wiersz['user_w'];
						$_SESSION['cena_a'] = $wiersz['cena_a'];
						$_SESSION['spadek'] = $wiersz['spadek'];
						$_SESSION['czas_s'] = $wiersz['czas_s'];
						$_SESSION['obraz'] = $wiersz['obraz'];
						$limit++;
						$i--;
          echo  '<p>';
									echo 	'<p>'.'Nazwa : '.$_SESSION['nazwa'].'<br/>';
									echo 	'Opis: '.$_SESSION['opis'].'<br/>';
									echo 	'Data rozpoczÄ™cia aukcji: '.$_SESSION['data_r'].'<br/>';
									echo 	'Data zakoÅ„czenia aukcji: '.$_SESSION['data_z'].'<br/>';
									echo 	'Cena wywoÅ‚awcza: '.$_SESSION['cena_w'].'<br/>';
									echo 	'<span style="color:green">Cena aktualna: '.$_SESSION['cena_a'].'<br/></span>';
									echo 	'Cena spada o: '.$_SESSION['spadek'].'<br/>';
									echo 	'W³a¶ciciel: '.$_SESSION['user_w'].'<br/>';
									echo 	'Cena spada co: '.$_SESSION['czas_s'].'<br/>';
									$obraz = $_SESSION['obraz'];
									echo 	"<img src= obrazy/'$obraz'.jpg />".'<br/>';
									echo'<form action="licytacja.php" method="post" >';
									echo 'Numer tej aukcji: '.'<input name="nr" type="text" value="'.$_SESSION['nr'].'" readonly="readonly" size="1"/>'.'<br/>';
									echo'<input type="submit" value="LICYTUJ"/>';
									echo'</form>'.'</p>';
									require_once('aktualizacja_holenderska.php');

									echo '<hr/>';
          echo ' </p>';
       echo '</div>';
   echo'</div>';
									
									

					}
									
				}
			}
				
				$polaczenie->close();
			}
			
		
		catch(Exception $e)
		{
			echo '<span style="color:red;">BÅ‚Ä…d serwera! Przepraszamy za niedogodnoÅ›ci i prosimy o skorzystanie z usÅ‚ugi w innym terminie!</span>';
			echo '<br />Informacja developerska: '.$e;
		}

		

?>
    </div>
    <div id="footer">
    &#169; Wszelkie prawa zastrze¿one. <br> 
    </div>
    </div>
</body>
</html>
