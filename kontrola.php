<?php

require_once "connect.php";
		mysqli_report(MYSQLI_REPORT_STRICT);
		
		$wszystko_OK=true;
		$pusto = '';
		try 
		{
			$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
			if ($polaczenie->connect_errno!=0)
			{
				throw new Exception(mysqli_connect_errno());
			}
			else
			{	
				$spr1 = $polaczenie->query("SELECT id,user_k,cena_a,nazwa FROM holenderska WHERE user_k != '$pusto' ");
				$spr1_tab = $spr1->fetch_assoc();
				$id = $spr1_tab['id'];
				$user_k = $spr1_tab['user_k'];
				$cena = $spr1_tab['cena_a'];
				$nazwa = $spr1_tab['nazwa'];
				
				$update = $polaczenie->query("INSERT INTO zakupione (id_aukcji,user,nazwa,cena) VALUES ($id,'$user_k','$nazwa',$cena)");
				
				$delete = $polaczenie->query(" DELETE FROM holenderska WHERE id='$id' ");
				
				
			}
			
				$polaczenie->close();
		}
		catch(Exception $e)
		{
			echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o skorzystanie z usługi w innym terminie!</span>';
			echo '<br />Informacja developerska: '.$e;
		}

?>