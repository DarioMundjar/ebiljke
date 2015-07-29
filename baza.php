<?php 
	$greska="";
	function spajanjeNaBazu(){
		$server = 'localhost';
		$baza = 'iwa_2014_vz_projekt';
		$korisnik = 'iwa_2014';
		$lozinka = 'foi2014';

		global $greska;
		$veza =  mysql_connect($server,$korisnik,$lozinka);
		if(!$veza){
			 $greska .= "Spajanje na bazu je neuspjelo!";
			 greske($greska);
			exit();
		}
		
		$BP = mysql_select_db($baza, $veza);

		if(!$BP) {
		$greska .= "Greška je: ".mysql_error();
			 greske($greska);
			 exit();
		}
		
		mysql_set_charset('utf8',$veza);
		return $veza;
	}
	function izvrsavanjeUpita($upit){
		global $greska;
		$rezultat = mysql_query($upit);
		if(!$rezultat){
			$greska .= "Greška je: ".mysql_error();
			 greske($greska);
			exit();
			}
		return $rezultat;
	}
	function zatvaranjeVeze($veza){
		mysql_close($veza);
	}
	
	function greske($greska) {
		
		echo $greska;
	}
 ?>