<?php
include("baza.php");
	$veza=spajanjeNaBazu();
	session_start();

	if(!isset($_SESSION['id'])){
		header("Location:index.php");
		exit();
	}
	else {
 		$id=$_GET['id'];
		$upit = "SELECT * FROM biljka";
		$biljka = izvrsavanjeUpita($upit);

	if (isset($_POST['dodaj'])){
		$biljka=$_POST['vrsta_id'];
		$datum = $_POST['datum'];
		$vrijeme=$_POST['vrijeme'];
		$opis = $_POST['opis'];
		$br_parcele = $_POST['parcela'];
		$br_biljke = $_POST['biljka'];
		if(!isset($br_biljke) || empty($br_biljke)){
			
			$unos = "INSERT INTO zapis (`zapis_id`,`zapisnik_id`,`biljka_id`,`datum`,`vrijeme`,`opis`,`broj_parcele`,`broj_biljke`) 
			VALUES (DEFAULT,'".$id."', '".$biljka."','".$datum."','".$vrijeme."','".$opis."','".$br_parcele."',DEFAULT)";
		}
		else {
			$unos = "INSERT INTO zapis (`zapis_id`,`zapisnik_id`,`biljka_id`,`datum`,`vrijeme`,`opis`,`broj_parcele`,`broj_biljke`) 
			VALUES (DEFAULT,'".$id."', '".$biljka."','".$datum."','".$vrijeme."','".$opis."','".$br_parcele."','".$br_biljke."')";

		}
			izvrsavanjeUpita($unos);
			header("Location:zapisi.php?id=$id");
			exit();	
	}
}	
 	?>
<html>
	<head>
		<title> Novi zapis </title>
		<meta charset="UTF-8" />
		<link href="css/autor.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="js/function.js"></script>
	</head> 
	<body>
	<?php include ("zaglavlje.php"); ?>
	<div class="zapis">
		<h2> Novi zapis </h2>
		<form name="zapisi" action="<?php echo $_SERVER["PHP_SELF"]."?id=".$id;?>" method="POST" onsubmit="return(validacija2());">	
			<label class="natpisi" for="vrsta_id">Odabir biljke: </label>
				<select class="unos" name="vrsta_id" id="vrsta_id">
					<?php
						while($row = mysql_fetch_array($biljka))
						{
							echo "<option value=\"".$row["biljka_id"]."\" ";
							echo ">".$row["naziv"]."</option>";
						}
						zatvaranjeVeze($veza);
					?>
				</select>
				<br/>
			<label class="natpisi" for="datum"> Datum </label>
			<input class="unos" type="text" name="datum" placeholder="yyyy-mm-dd" maxlength="10" size="10" />
			<br/>
			<label class="natpisi" for="vrijeme"> Vrijeme </label>
			<input class="unos" type="text" name="vrijeme" placeholder="hh:mm:ss" maxlength="8" size="8"/>
			<br/>
			<label class="natpisi" for="opis" > Opis </label>
			<textarea class="unos_area" name="opis"></textarea>
			<br/>
			<br/>
			<br/>
			<label class="natpisi" for="parcela"> Broj parcele </label>
			<input class="unos" type="text" name="parcela" placeholder="Broj parcele"/>
			<br/>
			<label class="natpisi" for="biljka"> Broj biljke </label>
			<input class="unos" type="text" name="biljka" placeholder="Broj biljke (opcionalno)"/>
			<br/>
			<input class="btnZapisnik" type="submit" name="dodaj" value="Dodaj zapis" />
		</form>	
		</div>	
	</body>
</html>