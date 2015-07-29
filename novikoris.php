<?php
	include("baza.php");
	$veza=spajanjeNaBazu();
	session_start();

	if(!isset($_SESSION['id'])){
		header("Location:index.php");
		exit();
	}
	else {
 	if($_SESSION['tip']== 0) {

	if (isset($_POST['unos'])){
		$ime=$_POST['ime'];
		$lozinka = $_POST['lozinka'];
		$tip=$_POST['tip'];
		$unos = "INSERT INTO korisnik (`korisnik_id`,`tip_id`,`korisnicko_ime`,`lozinka`) 
			VALUES (DEFAULT,'".$tip."','".$ime."','".$lozinka."')";
			izvrsavanjeUpita($unos);
			
			header("Location:korisnici.php");
			exit();	
		}
	} else {
		header("Location:index.php");
		exit();
	}
}
?>	
<html>
	<head>
		<title> Novi korisnik </title>
		<meta charset="UTF-8" />
		<link href="css/autor.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="js/function.js"></script>
	</head>
	<body> 
	<?php
		include ("zaglavlje.php");
		?>
		<div class="unosi">
		<h2>Unos korisnika </h2>
		<form name="korisnici" method="POST" action="<?php echo $_SERVER["PHP_SELF"] ?>" onsubmit="return(validacija3());">
			<label class="natpisi" for="ime"> Korisničko ime: </label>
			<input class="unos" name="ime" type="text" />
			<br/>
			<br/>
			<label class="natpisi" for="lozinka"> Lozinka: </label>
			<input class="unos" name="lozinka" type="password" />
			<br/>
			<br/>
			<label class="natpisi" for="tip">Tip korisnika</label>
			<br/>
			<input type="radio" name="tip" value="0"/>Administrator
			<br/>
			<input type="radio" name="tip" value="1"/>Voditelj
			<br/>
			<input type="radio" name="tip" value="2"/>Korisnik
			<br/>
			<input class="btnPrijava" type="submit" value="Unesi" name="unos" />
		</form>
		</div>
	</body>
</html>
<?php zatvaranjeVeze($veza); ?>