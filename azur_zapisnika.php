<?php 
include ("baza.php");
$veza=spajanjeNaBazu();
session_start();

	if(!isset($_SESSION["id"])){
		header("Location:index.php");
		exit();
	} else {
		$zapisnik_update_id = $_GET['id'];
		$upit = "SELECT * FROM zapisnik WHERE zapisnik_id ='".$zapisnik_update_id."'";
		$rezultat = izvrsavanjeUpita($upit);
		while($row = mysql_fetch_array($rezultat)){
			$naziv = $row['naziv'];
			$opis = $row['opis'];	
				}
			}
	if(isset($_POST['azuriraj'])){
		$naziv=$_POST['naziv'];
		$opis = $_POST['opis'];
		$datum = date("Y-m-d");
		if(isset($naziv) && !empty($naziv)){
		$update = "UPDATE zapisnik SET `korisnik_id`='".$_SESSION['id']."',`naziv` = '".$naziv."',`datum_kreiranja`='".$datum."', `opis`='".$opis."' WHERE zapisnik_id ='".$zapisnik_update_id."'";
		izvrsavanjeUpita($update);
		header("Location:index.php");
		exit();
	} else {
		$greska ="";
	}
	}
?>
<html>
	<head>
		<title> Ažuriranje zapisnika </title>
		<meta charset="UTF-8" />
		<link href="css/autor.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="js/function.js"></script>
	</head>
	<body> 
	<?php include("zaglavlje.php"); ?>
	<div class="zapisnik">
	<h2> Ažuriranje zapisnika </h2>
		<form name="zapisnik" action="<?php echo $_SERVER["PHP_SELF"]."?id=".$zapisnik_update_id; ?>" method="POST" onsubmit="return(validacija1());">	
		<label class="natpisi" for="naziv"> Naziv zapisnika </label>
			<input class="unos" type="text" name="naziv" value="<?php echo $naziv;  ?>"/>
			<br/>
			<br/>
			<label class="natpisi" for="opis"> Opis </label>
			<textarea class="unos_area" name="opis"><?php echo $opis;  ?></textarea>
			<br/>
			<input class="btnZapisnik" type="submit" name="azuriraj" value="Ažuriraj" />
		</form>
		</div>
		
	</body>
</html>
<?php zatvaranjeVeze($veza); ?>