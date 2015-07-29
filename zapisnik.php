<?php
	include ("baza.php");
	$veza=spajanjeNaBazu();
	session_start();

	if(!isset($_SESSION['id'])){
	header("Location: index.php");
	exit();
	} 
	if(isset($_POST['zapisnik'])){
		$naziv=$_POST['naziv'];
		$opis = $_POST['opis'];
		$id = $_SESSION['id'];
		$datum = date("Y-m-d");
		if(isset($naziv) && !empty($naziv)){
			$unos = "INSERT INTO zapisnik (`zapisnik_id`,`korisnik_id`,`naziv`,`datum_kreiranja`,`opis`) 
			VALUES (DEFAULT,'".$id."', '".$naziv."','".$datum."','".$opis."')";
			izvrsavanjeUpita($unos);
			header("Location:index.php");
			exit();
		}
	}
?>
<html>
	<head>
		<title> Zapisnik </title>
		<meta charset="UTF-8" />
		<link href="css/autor.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="js/function.js"></script>
	</head>
	<body> 
	<?php include("zaglavlje.php"); ?>
		<div class="zapisnik">
		<h2> Novi zapisnik </h2>
			<form name="zapisnik" action="<?php echo $_SERVER["PHP_SELF"] ?>" method="POST" onsubmit="return(validacija1());">	
			<label class="natpisi" for="naziv"> Naziv zapisnika </label>
				<input class="unos" type="text" name="naziv" />
				<br/>
				<br/>

				<label class="natpisi" for="opis"> Opis </label>
				<textarea class="unos_area" name="opis"></textarea>
				<br/>
				<input class="btnZapisnik" type="submit" name="zapisnik" value="Kreiraj" />
			</form>
			<div id="greska"> </div>
			</div>
	</body>
</html>
<?php zatvaranjeVeze($veza);?>