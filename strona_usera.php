<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Aukcje</title>

<link rel="stylesheet" type="text/css" href="css/main.css" />
 
</head>

<body>

	<div id="container">

        <div id="header_logo">
        	<a href="#"><img src="images/logo.jpg" alt="Logo" /></a>
        </div>
        <div id="header_left_top_info">
        <p>JesteÅ› zalogowany >> bierz udziaÅ‚ w aukcjach.</p>
        </div>
		<?php
session_start();
require_once "kontrola.php";
if ((!isset($_SESSION['zalogowany'])))
	{
		header('Location: index.php');
		exit();
	}

$nazwa = $_SESSION['user'];
$email = $_SESSION['email'];
$imie = $nazwa;
$_SESSION['imie'] = $imie;?>
        <div id="header_menu">
        	<ul>
            	<li><h3><?php echo $nazwa; ?></h3></li>
                <li><h3><?php echo $email; ?></h3></li>
				 <li> <form action="nowa_aukcja.php" method="post">
					<input type="submit" value="DODAJ NOWÃ„Â„ AUKCJÃ„Â˜"/>
					</form></li>
					<li><form name="logout" action="logout.php" method="post">
					<input type="submit" value="Wyloguj">
					</form></li>
            </ul>
        </div>
	<div id="header_main">
    <div id="header_main_image"></div>
    	<div id="header_main_text">
        	<h2>Komunikator</h2>
            <p>
           MoÅ¼esz napisaÄ‡ wiadomoÅ›Ä‡ do innego uÅ¼ytkownika.
            </p>
			<div name="poczta" >
<b>Wiadomo&#347;ci do ciebie:</b><br/>
<iframe src="poczta_przychodzaca.php" width="400px" height="70px" ></iframe><br>
<b>Napisz wiadomo&#347;c do innego u&#380;ytkownika</b>
<form action="poczta.php" method ="post">
Wybierz adresata : <select name="adresat">
	<?php	 require_once "connect.php";

			$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
			if ($polaczenie->connect_errno!=0)
			{
				throw new Exception(mysqli_connect_errno());
			}
			else
			{	
			
					$licz = $polaczenie->query("SELECT id FROM users ORDER BY id DESC LIMIT 1 ");
					$liczba_wierszy = $licz->fetch_assoc();
					$i = $liczba_wierszy['id'];
					$limit = 0;
					$_SESSION['i'] = $i;

					while($i>0)
					{
						
						$h = $polaczenie->query("SELECT id FROM users ORDER BY id DESC LIMIT 1 ");
						$k = $h->fetch_assoc();
						$id = $k['id'];
						$id = $id-$limit;
						$pozycja = $polaczenie->query("SELECT * FROM users WHERE id = '$id' ");
						$wiersz = $pozycja->fetch_assoc();
						$_SESSION['adresat'] = $wiersz['nazwa'];
						$limit++;
						$i--;
						
						if($_SESSION['adresat'] != '' )
						{echo '<option>'.$_SESSION['adresat'].'</option>';}
					
				}

			}
				
		 $polaczenie->close();
		 

?>
</select><br/>
Napisz wiadomo&#347;&#263; : <input type="text" name="list" />
<input type="submit" value="wy&#347;lij"/>
</form>
</div>
        </div>
	</div>
    <div id="boxy">
    		<div id="boxy_text_1">
        	<h2>Bierz udziaÅ‚ we wszystkich aukcjach!</h2>
            <span>
           PrzeglÄ…daj aukcje oraz zarzÄ…dzaj swoimi.
            </span>
            </div>
           <form action="" method="post">
            <div id="boxy_images">
            
         <input type="radio" name="klasyczna" value="klasyczna"/><img src="images/cat_b.jpg" />
            
          <input type="radio" name="min" value="min"/><img src="images/cat_d.jpg" />
           
          <input type="radio" name="holenderska" value="holenderska"/><img src="images/cat_ce.jpg" />
		  
		  <input type="radio" name="moje_aukcje" value="moje_aukcje"/><img src="images/mojeaukcje.jpg" /><br>
		  <input type="submit" value="szukaj"/>
			</form>
            </div>
            

    </div>    
    <div id="boxy_content">
    	<div id="boxy_content_lx">
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
									echo 	'Data rozpoczÃ„Â™cia aukcji: '.$_SESSION['data_r'].'<br/>';
									echo 	'Data zakoÄ¹Â„czenia aukcji: '.$_SESSION['data_z'].'<br/>';
									echo 	'Cena: '.$_SESSION['cena_w'].'<br/>';
									echo 	'WÅ‚aÅ›ciciel: '.$_SESSION['user_w'].'<br/>';
									$obraz = $_SESSION['obraz'];
									echo 	"<img src= obrazy/'$obraz'.jpg />".'<br/>';
									echo'<form action="licytacja.php" method="post" >';
									echo 'Numer tej aukcji: '.'<input type="text" name="nr" value="'.$_SESSION['nr'].'" readonly="readonly" size="1"/>'.'<br/>';
									echo'<input type="submit" value="LICYTUJ"/>';
									echo'</form>'.'</p>';
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
									echo 	'Data rozpoczÃ„Â™cia aukcji: '.$_SESSION['data_r'].'<br/>';
									echo 	'Data zakoÄ¹Â„czenia aukcji: '.$_SESSION['data_z'].'<br/>';
									echo 	'Cena: '.$_SESSION['cena_w'].'<br/>';
									echo 	'WÅ‚aÅ›ciciel: '.$_SESSION['user_w'].'<br/>';
									$obraz = $_SESSION['obraz'];
									echo 	"<img src= obrazy/'$obraz'.jpg />".'<br/>';
									echo'<form action="licytacja.php" method="post" >';
									echo 'Numer tej aukcji: '.'<input type="text" name="nr" value="'.$_SESSION['nr'].'" readonly="readonly" size="1"/>'.'<br/>';
									echo'<input type="submit" value="LICYTUJ"/>';
									echo'</form>'.'</p>';
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
									echo 	'Data rozpoczÃ„Â™cia aukcji: '.$_SESSION['data_r'].'<br/>';
									echo 	'Data zakoÄ¹Â„czenia aukcji: '.$_SESSION['data_z'].'<br/>';
									echo 	'Cena: '.$_SESSION['cena_w'].'<br/>';
									echo 	'WÅ‚aÅ›ciciel: '.$_SESSION['user_w'].'<br/>';
									$obraz = $_SESSION['obraz'];
									echo 	"<img src= obrazy/'$obraz'.jpg />".'<br/>';
									echo'<form action="licytacja.php" method="post" >';
									echo 'Numer tej aukcji: '.'<input type="text" name="nr" value="'.$_SESSION['nr'].'" readonly="readonly" size="1"/>'.'<br/>';
									echo'<input type="submit" value="LICYTUJ"/>';
									echo'</form>'.'</p>';
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
									echo 	'Data rozpoczÃ„Â™cia aukcji: '.$_SESSION['data_r'].'<br/>';
									echo 	'Data zakoÄ¹Â„czenia aukcji: '.$_SESSION['data_z'].'<br/>';
									echo 	'Cena: '.$_SESSION['cena_w'].'<br/>';
									echo 	'Cena minimalna: '.$_SESSION['cena_m'].'<br/>';
									echo 	'WÅ‚aÅ›ciciel: '.$_SESSION['user_w'].'<br/>';
									$obraz = $_SESSION['obraz'];
									echo 	"<img src= obrazy/'$obraz'.jpg />".'<br/>';
									echo'<form action="licytacja.php" method="post" >';
									echo 'Numer tej aukcji: '.'<input type="text" name="nr" value="'.$_SESSION['nr'].'" readonly="readonly" size="1"/>'.'<br/>';
									echo'<input type="submit" value="LICYTUJ"/>';
									echo'</form>'.'</p>';
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
									echo 	'Data rozpoczÃ„Â™cia aukcji: '.$_SESSION['data_r'].'<br/>';
									echo 	'Data zakoÄ¹Â„czenia aukcji: '.$_SESSION['data_z'].'<br/>';
									echo 	'Cena: '.$_SESSION['cena_w'].'<br/>';
									echo 	'Cena minimalna: '.$_SESSION['cena_m'].'<br/>';
									echo 	'WÅ‚aÅ›ciciel: '.$_SESSION['user_w'].'<br/>';
									$obraz = $_SESSION['obraz'];
									echo 	"<img src= obrazy/'$obraz'.jpg />".'<br/>';
									echo'<form action="licytacja.php" method="post" >';
									echo 'Numer tej aukcji: '.'<input type="text" name="nr" value="'.$_SESSION['nr'].'" readonly="readonly" size="1"/>'.'<br/>';
									echo'<input type="submit" value="LICYTUJ"/>';
									echo'</form>'.'</p>';
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
									echo 	'Data rozpoczÃ„Â™cia aukcji: '.$_SESSION['data_r'].'<br/>';
									echo 	'Data zakoÄ¹Â„czenia aukcji: '.$_SESSION['data_z'].'<br/>';
									echo 	'Cena: '.$_SESSION['cena_w'].'<br/>';
									echo 	'Cena minimalna: '.$_SESSION['cena_m'].'<br/>';
									echo 	'WÅ‚aÅ›ciciel: '.$_SESSION['user_w'].'<br/>';
									$obraz = $_SESSION['obraz'];
									echo 	"<img src= obrazy/'$obraz'.jpg />".'<br/>';
									echo'<form action="licytacja.php" method="post" >';
									echo 'Numer tej aukcji: '.'<input type="text" name="nr" value="'.$_SESSION['nr'].'" readonly="readonly" size="1"/>'.'<br/>';
									echo'<input type="submit" value="LICYTUJ"/>';
									echo'</form>'.'</p>';
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
									echo 	'Data rozpoczÃ„Â™cia aukcji: '.$_SESSION['data_r'].'<br/>';
									echo 	'Data zakoÄ¹Â„czenia aukcji: '.$_SESSION['data_z'].'<br/>';
									echo 	'Cena wywoÄ¹Â‚awcza: '.$_SESSION['cena_w'].'<br/>';
									echo 	'<span style="color:green">Cena aktualna: '.$_SESSION['cena_a'].'<br/></span>';
									echo 	'Cena spada o: '.$_SESSION['spadek'].'<br/>';
									echo 	'WÅ‚aÅ›ciciel: '.$_SESSION['user_w'].'<br/>';
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
									echo 	'Data rozpoczÃ„Â™cia aukcji: '.$_SESSION['data_r'].'<br/>';
									echo 	'Data zakoÄ¹Â„czenia aukcji: '.$_SESSION['data_z'].'<br/>';
									echo 	'Cena wywoÄ¹Â‚awcza: '.$_SESSION['cena_w'].'<br/>';
									echo 	'<span style="color:green">Cena aktualna: '.$_SESSION['cena_a'].'<br/></span>';
									echo 	'Cena spada o: '.$_SESSION['spadek'].'<br/>';
									echo 	'WÅ‚aÅ›ciciel: '.$_SESSION['user_w'].'<br/>';
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
									echo 	'Data rozpoczÃ„Â™cia aukcji: '.$_SESSION['data_r'].'<br/>';
									echo 	'Data zakoÄ¹Â„czenia aukcji: '.$_SESSION['data_z'].'<br/>';
									echo 	'Cena wywoÄ¹Â‚awcza: '.$_SESSION['cena_w'].'<br/>';
									echo 	'<span style="color:green">Cena aktualna: '.$_SESSION['cena_a'].'<br/></span>';
									echo 	'Cena spada o: '.$_SESSION['spadek'].'<br/>';
									echo 	'WÅ‚aÅ›ciciel: '.$_SESSION['user_w'].'<br/>';
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
								else if(isset($_POST['moje_aukcje']))
				{
					$_POST['klasyczna'] = TRUE;
					$_POST['min'] = TRUE;
					$_POST['holenderska'] = TRUE;
					require_once "moje_aukcje.php";

				}
			}
				
				$polaczenie->close();
			}
			
		
		catch(Exception $e)
		{
			echo '<span style="color:red;">BÄ¹Â‚Ã„Â…d serwera! Przepraszamy za niedogodnoÄ¹Â›ci i prosimy o skorzystanie z usÄ¹Â‚ugi w innym terminie!</span>';
			echo '<br />Informacja developerska: '.$e;
		}

		

?>
    </div>
    <div id="footer">
    Â© Wszelkie prawa zastrzeÅ¼one. <br>
    </div>
    </div>
</body>
</html>
