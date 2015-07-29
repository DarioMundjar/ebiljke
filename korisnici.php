<?php 
include_once ("baza.php");
$veza=spajanjeNaBazu();
session_start();
if(!isset($_SESSION['id'])){
		header("Location:index.php");
		exit();
	}
	
?>

<html>
	<head>
		<title> Korisnici </title>
		<meta charset="UTF-8" />
		<link href="css/autor.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="js/function.js"></script>
	</head>
	<body> 
	<?php
		include ("zaglavlje.php");
		if(isset($_GET['id'])){
		$id=$_GET['id'];
		$upit = "SELECT * FROM korisnik WHERE korisnik_id='".$id."'";
		$rez= izvrsavanjeUpita($upit);
		$ispis = mysql_fetch_assoc($rez);
		?>
		<div class="azur_korisnika"  id="azur_korisnika">
		<h2>Ažuriranje korisnika </h2>
		<form name="kor_azur" action="<?php echo $_SERVER["PHP_SELF"]."?id=".$id; ?>" method="POST" onsubmit="validacija6();">
			<label class="natpisi" for="tip">Tip korisnika</label>
			<br/>
			<input  type="radio" name="tip" <?php if ($ispis['tip_id']==0 ){
				echo "checked=\"checked\" ";
			} ?> value="0"/>Administrator
			<br/>
			<input  type="radio" name="tip" <?php if ($ispis['tip_id']==1){
				echo "checked=\"checked\" ";
			} ?> value="1"/>Voditelj
			<br/>
			<input  type="radio" name="tip" <?php if ($ispis['tip_id']==2){
				echo "checked=\"checked\" ";
			} ?> value="2"/>Korisnik
			<br/>
			<label class="natpisi" for="ime">Ime</label>
			<input class="unos" type="text" name="ime"  value = "<?php echo $ispis['ime']; ?>" />
			<br/>
			<br/>
			<label class="natpisi" for="prezime">Prezime</label>
			<input class="unos" type="text" name="prezime" value = "<?php echo $ispis['prezime']; ?>" />
			<br/>
			<br/>
			<label class="natpisi" for="email">Email</label>
			<input class="unos" type="text" name="email" value = "<?php echo $ispis['email']; ?>" />
			<br/>
			<br/>
			<label class="natpisi" for="slika">Slika</label>
			<input class="unos" type="text" name="slika" value = "<?php echo $ispis['slika']; ?>" />
			<br/>
			<br/>
			<input class="btn" type="submit" name="azuriraj" value="Ažuriraj" />
		</form>
		<?php
		if(isset($_POST['azuriraj'])){
			$tip = $_POST['tip'];
			$ime = $_POST['ime'];
			$prezime = $_POST['prezime'];
			$email = $_POST['email'];
			$slika = $_POST['slika'];
				$update = "UPDATE korisnik SET `tip_id`='".$tip."',`ime`='".$ime."',`prezime`='".$prezime."',`email`='".$email."',`slika`='".$slika."'  WHERE korisnik_id='".$id."'";
				izvrsavanjeUpita($update);
				$korisnici = izvrsavanjeUpita($upit);
		}
	}
	?>
	</div>
		 <div class="ispis_zapisa" id="zapisi">
		 <div class="filter">
		 Filteri: 
			<a href="korisnici.php?filter=1">Filtriraj po tipu </a>
			<a href="korisnici.php?filter=2">Filtriraj po prezimenu </a>
		</div>
		<table>
			<tr>
				<th> Tip </th>
				<th> Korisničko ime </th>
				<th> Ime </th>
				<th> Prezime </th>
				<th> Email </th>
				<th> Ažuriranje </th>
			</tr>
		<?php 
		if($_SESSION['tip']==0) {
		if(isset($_GET['filter'])){
		$filter=$_GET['filter']; 
		if($filter==1){
		$upit = "SELECT * FROM korisnik koris, tip_korisnika tip WHERE tip.tip_id=koris.tip_id ORDER BY koris.tip_id";
		} else if($filter==2){
			$upit = "SELECT * FROM korisnik koris, tip_korisnika tip WHERE tip.tip_id=koris.tip_id ORDER BY  koris.prezime";
		} else {
			$upit = "SELECT * FROM korisnik koris, tip_korisnika tip WHERE tip.tip_id=koris.tip_id ORDER BY koris.korisnik_id";
		}
		}
		else{
			$upit = "SELECT * FROM korisnik koris, tip_korisnika tip WHERE tip.tip_id=koris.tip_id ORDER BY koris.korisnik_id";
		}
	}
		
		else {
			header("Location:index.php");
			exit();
	}
	$korisnici = izvrsavanjeUpita($upit);
			while($row = mysql_fetch_array($korisnici)){
				
					echo "<tr>";
					echo "<td>".$row["naziv"]."</td>";
					echo "<td>".$row["korisnicko_ime"]."</td>";
					echo "<td>".$row["ime"]."</td>";
					echo "<td>".$row["prezime"]."</td>";
					echo "<td>".$row["email"]."</td>";
					echo "<td><a href=\"korisnici.php?id=".$row["korisnik_id"]."\">Ažuriraj</a></td>";
					echo "</tr>";	
				}
				zatvaranjeVeze($veza);
		?>
		</table>
		
		</div>


		<div id="greske"></div>
		
	</body>
</html>
