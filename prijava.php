<?php
	include ("baza.php");
	$veza = spajanjeNaBazu();
	if(isset($_GET["odjava"])){
		session_start();
		unset($_SESSION["id"]);
		unset($_SESSION["ime"]);
		unset($_SESSION["tip"]);
		session_destroy();
		header("Location:index.php");
		exit();
	}
	session_start();
	if(isset($_SESSION['id'])){
		header("Location:index.php");
		exit();
	}
	if(isset($_POST['prijava'])){
		if (isset($_POST['ime']) && isset($_POST['lozinka'])){
			$kor_ime = $_POST['ime'];
			$lozinka = $_POST ['lozinka'];
				$upit = "SELECT * FROM korisnik 
				WHERE korisnicko_ime = '".$kor_ime."' 
				AND lozinka = '".$lozinka."'";
				
				$rezultat = izvrsavanjeUpita($upit);
				$loginOK = false;
				while($row = mysql_fetch_array($rezultat)){
					$loginOK = true;
					session_start();
					$_SESSION['id']=$row['korisnik_id'];
					$_SESSION['tip']=$row['tip_id'];
					$_SESSION['kor_ime']= $row['korisnicko_ime'];
					header("Location:index.php");
		}

	}
}
?>
<html>
	<head>
		<title> Prijava </title>
		<meta charset="UTF-8" />
		<link href="css/autor.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="js/function.js"></script>	
	</head>
	<body class="prijavaPozad"> 
	<?php
		include ("zaglavlje.php");
		?>
		<div class="prijava">
		<h2>Prijava  </h2>
		<form name="prijava" method="POST" action="<?php echo $_SERVER["PHP_SELF"] ?>" onsubmit="validacija5();">
			<label class="natpisi" for="ime"> Korisničko ime: </label>
			<input class="unos" name="ime" type="text" />
			<br/>
			<br/>
			<label class="natpisi" for="lozinka"> Lozinka: </label>
			<input class="unos" name="lozinka" type="password" />
			<br/>
			<input class="btnPrijava" type="submit" value="Prijava" name="prijava" />
		</form>
		<div id="greske"></div>
		</div>
	</body>
</html> 
<?php zatvaranjeVeze($veza); ?>
