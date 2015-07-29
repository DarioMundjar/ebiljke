<?php
	include("baza.php");
	$veza=spajanjeNaBazu();
	session_start();

	if(!isset($_SESSION['id'])){
		header("Location:index.php");
		exit();
	}
	else {
		if($_SESSION['tip']== 2){
			header("Location:index.php");
		exit();
		}

 	if($_SESSION['tip']== 1) {
	$upit1 = "SELECT b.biljka_id as id, b.naziv as naz_biljke, v.naziv as naz_vrste FROM biljka b, vrsta v 
	WHERE v.korisnik_id = '".$_SESSION['id']."' and b.vrsta_id=v.vrsta_id ORDER BY v.naziv, b.naziv";
	$rezultat = izvrsavanjeUpita($upit1);
	
	}
	
	if($_SESSION['tip']==0){
		$upit1 = "SELECT b.biljka_id as id, b.naziv as naz_biljke, v.naziv as naz_vrste FROM biljka b, vrsta v 
	WHERE b.vrsta_id=v.vrsta_id ORDER BY v.naziv, b.naziv";
	$rezultat = izvrsavanjeUpita($upit1);
	}
}
 	?>
<html>
	<head>
		<title> Pregled biljaka </title>
		<meta charset="UTF-8" />
		<link href="css/autor.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="js/function.js"></script>
	</head> 
	<body>
	<?php include("zaglavlje.php"); ?>
	<div class="azur_popisa">
		
		<?php
		if(isset($_GET['id'])){
		$id=$_GET['id'];
		$upit = "SELECT naziv FROM biljka WHERE biljka_id='".$id."'";
		$rez= izvrsavanjeUpita($upit);
		$ispis = mysql_fetch_assoc($rez);
		$adresa=$_SERVER["PHP_SELF"]."?id=".$id; ?>
		<h4>Ažuriranje biljke</h4>
		<form action="<?php echo $_SERVER["PHP_SELF"]."?id=".$id; ?>" method='POST'>
					<label for="naziv"><?php echo $ispis["naziv"]; ?></label>
					<input type="text" name='naziv'  value="<?php echo $ispis["naziv"]; ?>" />
					<input type="submit" name="azuriraj" value="Ažuriraj"/>
		</form>
	<?php
		if(isset($_POST['azuriraj'])){
			$naziv = $_POST['naziv'];	
			if(isset($naziv)&&!empty($naziv)){
				$update = "UPDATE biljka SET `naziv`='".$naziv."' WHERE biljka_id='".$id."'";
				$rez= izvrsavanjeUpita($update);
			$rezultat = izvrsavanjeUpita($upit1);
			}
		}
	}
	?>
	<img src="img/flower.png" />
	</div>
		  <div class="ispis_zapisa" id="zapisi"> 
		<table>
		<tr>
				<th> Biljka </th>
				<th> Vrsta </th>
				<th> Broj zapisa </th>
				<th> Ažuriraj </th>
		 </tr>
		<?php 
		$i=0;
			while($row = mysql_fetch_array($rezultat)){
				$upit="SELECT count(*) FROM  zapis  WHERE biljka_id = '".$row['id']."'";
				$rez=izvrsavanjeUpita($upit);
				$biljka = mysql_fetch_row($rez);
					echo "<tr>";
					echo "<td>".$row["naz_biljke"]."</td>";
					echo "<td>".$row["naz_vrste"]."</td>";
					echo "<td>".$biljka[0]."</td>";
					echo "<td><a href=\"popis_mod.php?id=".$row["id"]."\">Ažuriraj</a></td>";
					echo "</tr>";	
					$i++;
				}
				if($i==0){
						echo "<tr>";
						echo "<td class=\"prazno\" colspan=\"4\">Nema zapisa </td>";
						echo "</tr>";
				}
				zatvaranjeVeze($veza);
		?>
		</table>
		</div>
	</body>
</html>

	
