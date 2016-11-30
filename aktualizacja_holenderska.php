<?php


				$daty = $polaczenie->query("SELECT data_r,data_z,cena_w,cena_a,spadek,czas_s,dolna_granica FROM holenderska WHERE id='$id' ");
				$aktualizacja_tab = $daty->fetch_assoc();
				$data_r = $aktualizacja_tab['data_r'];
				$data_z = $aktualizacja_tab['data_z'];
				$cena_w = $aktualizacja_tab['cena_w'];
				$cena_a = $aktualizacja_tab['cena_a'];
				$spadek = $aktualizacja_tab['spadek'];
				$czas_s = $aktualizacja_tab['czas_s'];
				$dolna_granica = $aktualizacja_tab['dolna_granica'];
				
				
				$F = date('Y-m-d');
				$F = strtotime($F);
				$H = strtotime($czas_s);
				$Q = $H - $F;
				
				$data_aktualna = Date('Y-m-d H:i:s');
				$A = strtotime($data_aktualna);
				$A = $A +3600;
				$W = strtotime($data_r);
				
				$R = $A - $W;

				$P = floor($R/$Q);
				
				$RC = $P*$spadek;
				
				$cena_n = $cena_w - $RC;
				
				if($dolna_granica<$cena_a)
				{
					
					$aktualizacja=$polaczenie->query("UPDATE holenderska SET cena_a = '$cena_n' WHERE id='$id' ");
				}
				
?>