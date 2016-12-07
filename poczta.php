<meta charset="UTF-8">
<?php
session_start();
 if(isset($_POST['list'] ))
 {
	 if($_POST['list'] != ''){
 require_once "connect.php";
		mysqli_report(MYSQLI_REPORT_STRICT);
		
		
		
		try 
		{
			$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
			if ($polaczenie->connect_errno!=0)
			{
				throw new Exception(mysqli_connect_errno());
			}
			else
			{	

				$data = date('Y-m-d H:i:s');
				$adresat = $_POST['adresat'];
				$tresc = $_POST['list'];
				$imie = $_SESSION['imie'];
				$zapisz=$polaczenie->query("INSERT INTO poczta(nadawca,adresat,tresc,data) VALUES('$imie', '$adresat', '$tresc', '$data') ");
				
				
			}
			
				
				$polaczenie->close();
			
		}
		
		catch(Exception $e)
		{
			echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o skorzystanie z usługi w innym terminie!</span>';
			echo '<br />Informacja developerska: '.$e;
		}
 }
 else
 {
	 $_SESSION['b_list'] = '<span style="color:blue"><b>Treść wiadomości nie może być pusta!</b></span>';
 }

header('location:strona_usera.php');
 }
 ?>