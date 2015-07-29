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
 		$zid=$_GET['zapis'];	
	$upit1 ="SELECT * FROM zapis WHERE zapis_id = '".$id."'";
	$rezultat = izvrsavanjeUpita($upit1);
	while($row = mysql_fetch_array($rezultat)){
			$biljka_id = $row['biljka_id'];
			$opis = $row['opis'];
			$datum = $row ['datum'];
			$vrijeme = $row['vrijeme'];
			$br_parcele = $row ['broj_parcele'];
			$br_biljke = $row ['broj_biljke'];	
				}
	$upit = "SELECT * FROM biljka"; 
	$biljka = izvrsavanjeUpita($upit);
	if (isset($_POST['azuriraj'])){
		$biljka=$_POST['vrsta_id'];
		$datum = $_POST['datum'];
		$vrijeme = $_POST['vrijeme'];
		$opis = $_POST['opis'];
		$br_parcele = $_POST['parcela'];
		$br_biljke = $_POST['biljka'];
		$zid=$_POST['zid'];
		if(!isset($br_biljke) || empty($br_biljke)){
			$update = "UPDATE zapis 
		SET `biljka_id`='".$biljka."', `datum`='".$datum."', 
		`vrijeme`='".$vrijeme."', `opis`='".$opis."', `broj_parcele`='".$br_parcele."', `broj_biljke`=DEFAULT 
		WHERE zapis_id ='".$id."'";
		}else {
			$update = "UPDATE zapis 
		SET `biljka_id`='".$biljka."', `datum`='".$datum."', 
		`vrijeme`='".$vrijeme."', `opis`='".$opis."', `broj_parcele`='".$br_parcele."', `broj_biljke`='".$br_biljke."' 
		WHERE zapis_id ='".$id."'";
		}
	
		izvrsavanjeUpita($update);
		header("Location:zapisi.php?zid=$zid");
		exit();		
	}
}
 	?>
 <html>
	<head>
		<title> Ažuriranje zapisa </title>
		<meta charset="UTF-8" />
		<link href="css/autor.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="js/function.js"></script>
	</head> 
	<body>
	<?php include ("zaglavlje.php"); ?>
	<div class="zapis">
		<h2> Ažuriranje zapisa </h2>
		<form name="zapisi" action="<?php echo $_SERVER["PHP_SELF"]."?id=".$id; ?>" method="POST" onsubmit="return(validacija2());">	
			<label class="natpisi"  for="vrsta_id">Odabir biljke: </label>
				<select class="unos" name="vrsta_id" id="vrsta_id">
					<?php
						while($row = mysql_fetch_array($biljka))
						{
							echo "<option value=\"".$row["biljka_id"]."\" ";
							if($row["biljka_id"] == $biljka_id)
							{
								echo " selected=\"selected\" ";
							}
							echo ">".$row["naziv"]."</option>";
						}
						zatvaranjeVeze($veza);
					?>
				</select>
				<br/>
			<label class="natpisi" for="datum"> Datum </label>
			<input class="unos" type="text" name="datum" value = "<?php echo $datum; ?>" maxlength="10" size="10" />
			<br/>
			<label class="natpisi" for="vrijeme"> Vrijeme </label>
			<input class="unos" tyclass="unos"pe="text" name="vrijeme" value = "<?php echo $vrijeme; ?>" /maxlength="8" size="8">
			<br/>
			<label class="natpisi" for="opis"> Opis </label>
			<textarea class="unos_area" name="opis"><?php echo $opis; ?></textarea>
			<br/>
			<br/>
			<br/>
			<label class="natpisi" for="parcela"> Broj parcele </label>
			<input class="unos" type="text" name="parcela" value="<?php echo $br_parcele; ?>" placeholder="Broj parcele" />
			<br/>
			
			<label class="natpisi" for="biljka"> Broj biljke </label>
			<input class="unos" type="text" name="biljka" value="<?php echo $br_biljke; ?>" placeholder="Broj biljke (opcionalno)"/>
			<br/>
			<input type="hidden" name="zid" value="<?php echo $zid; ?>">
			<input class="btnZapisnik" type="submit" name="azuriraj" value="Ažuriraj" />
		</form>
		</div>
	</body>
</html>