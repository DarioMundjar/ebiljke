<?php 
include_once ("baza.php");
$veza=spajanjeNaBazu();
session_start();
if(!isset($_SESSION['id'])){
		header("Location:index.php");
		exit();
	}
	else {
		if($_SESSION['tip']!=0){
			header("Location:index.php");
		exit();
		}
		$upit="SELECT * FROM vrsta v, korisnik k WHERE v.korisnik_id = k.korisnik_id";
		$rezultat = izvrsavanjeUpita($upit);
		
	}
	if(isset($_POST['azuriraj'])){
		$naziv = $_POST['naziv'];
		$moderator=$_POST['moderator'];
		$idv=$_POST['id'];	
		
		if(isset($naziv) && !empty($naziv) &&(isset($moderator) && !empty($moderator))){
			$update= "UPDATE vrsta SET `naziv`='".$naziv."', `korisnik_id`='".$moderator."' WHERE vrsta_id='".$idv."'";
			izvrsavanjeUpita($update);
			$rezultat = izvrsavanjeUpita($upit);
			
		}
	}
?>
<html>
	<head>
		<title> Pregled vrsta </title>
		<meta charset="UTF-8" />
		<link href="css/autor.css" rel="stylesheet" type="text/css" />
	</head>
	<body> 
	<?php include ("zaglavlje.php");?>	
	<div class="ispis_zapisa" id="zapisi">
			 <h2>Pregled vrsta po moderatorima </h2>
			<table>
			<tr>
					<th> Vrsta </th>
					<th> Moderator </th>
					<th> Ukupno biljke </th>
					<th> Ažuriranje </th>
					<th> Pregled </th>
			 </tr>
			<?php 
				while($row = mysql_fetch_array($rezultat)){
					$upit="SELECT count(*) FROM  biljka  WHERE vrsta_id = '".$row['vrsta_id']."'";
					$rez=izvrsavanjeUpita($upit);
					$biljke = mysql_fetch_row($rez);
					
						echo "<tr>";
						echo "<td>".$row["naziv"]."</td>";
						echo "<td>".$row["korisnicko_ime"]."</td>";
						echo "<td>".$biljke[0]."</td>";
						echo "<td><a href=\"vrste_bilj.php?id=".$row["vrsta_id"]."&idk=".$row['korisnik_id']."\">Ažuriraj</a></td>";
						echo "<td><a href=\"vrste_bilj.php?idb=".$row["vrsta_id"]."\">Pregledaj</a></td>";
						echo "</tr>";	
					}
			?>
			</table>
		</div>
		<?php
		if(isset($_GET['id']) && isset($_GET['idk'])){
			$id=$_GET['id'];
			$idk=$_GET['idk'];
			$upit2 = "SELECT * FROM korisnik WHERE tip_id='1'";
			$rezultat2 = izvrsavanjeUpita($upit2);
			$upit3="SELECT * FROM vrsta WHERE vrsta_id='".$id."'";
			$rezultat3=izvrsavanjeUpita($upit3);	
			$biljka = mysql_fetch_row($rezultat3);
		?>
		<div class="azur_mod">
		<h4>Ažuriranje </h4>
			<form action="<?php echo $_SERVER["PHP_SELF"]."?id=".$id; ?>" method="POST">
			<label class="natpisi" for="naziv"> Naziv vrste: </label>
			<input class="unos" name="naziv" type="text" value="<?php echo $biljka[1]; ?>" />
			<input name="id" type="hidden" value="<?php echo $biljka[0]; ?>" />
			<br/>
			<label class="natpisi" for="moderator"> Moderator: </label>
				<select name="moderator" id="moderator">
					<?php
						while($row = mysql_fetch_array($rezultat2))
						{
							echo "<option value=\"".$row["korisnik_id"]."\"";
							if($row["korisnik_id"] == $idk)
							{
								echo " selected=\"selected\" ";
							}
							echo ">".$row["korisnicko_ime"]."</option>";
						}
					?>
				</select>
				<br/>
			<input class="btnPrijava" type="submit" value="Ažuriraj" name="azuriraj" />
			</form>
		</div>
		<?php } ?>
			<?php
		if(isset($_GET['idb'])){
			$idb=$_GET['idb'];
			$upit2 = "SELECT * FROM biljka  WHERE vrsta_id = '".$idb."'GROUP BY naziv";
			$rezultat2 = izvrsavanjeUpita($upit2);
			$naziv="SELECT naziv from vrsta WHERE vrsta_id='".$idb."'";
			$rezultat4 = izvrsavanjeUpita($naziv);
			$vrsta = mysql_fetch_row($rezultat4);
		?>
		<div class="azur_mod">
			<h4> Zapisi po biljkama, vrsta:  <?php echo $vrsta[0]; ?> </h4>
			<table>
				<tr>
					<th> Biljka </th>
					<th> Broj zapisa </th>
			 	</tr>
		<?php 
		$i=0;
			while($row = mysql_fetch_array($rezultat2)){
			$upit3 = "SELECT count(*) FROM  zapis WHERE biljka_id='".$row['biljka_id']."' ";
			$rezultat3 = izvrsavanjeUpita($upit3);
			$biljka = mysql_fetch_row($rezultat3);
					echo "<tr>";
					echo "<td>".$row["naziv"]."</td>";
					echo "<td>".$biljka[0]."</td>";
					echo "</tr>";	
					$i++;
				}
				if($i==0){
			echo "<tr>";
						echo "<td class=\"prazno\" colspan=\"2\">Nema zapisa </td>";
						echo "</tr>";
				}
		?>
		</table>
		</div>
		<?php } zatvaranjeVeze($veza);?>
		</body>
	</html>