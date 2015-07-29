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
		$naziv=$_POST['naziv'];
		$moderator = $_POST['moderator'];
		if(isset($naziv) && !empty($naziv) &&(isset($moderator) && !empty($moderator))){
			$unos= "INSERT INTO vrsta (`vrsta_id`,`naziv`,`korisnik_id`) 
			VALUES (DEFAULT,'".$naziv."','".$moderator."')";
			izvrsavanjeUpita($unos);
			header("Location:vrste_bilj.php");
			exit();	
		}
	}
	$upit2 = "SELECT * FROM korisnik WHERE tip_id='1'";
		$rezultat2 = izvrsavanjeUpita($upit2);
	} else {
		header("Location:index.php");
		exit();
	}
}
?>
<html>
	<head>
		<title> Nova vrsta </title>
		<meta charset="UTF-8" />
		<link href="css/autor.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="js/function.js"></script>
	</head>
	<body> 
	<?php
		include ("zaglavlje.php");
		?>
		<div class="nova">
		<h2>Nova vrsta </h2>
		<form name="vrsta" method="POST" action="<?php echo $_SERVER["PHP_SELF"] ?>" onsubmit="return(validacija4());">
			<label class="natpisi" for="naziv">Naziv vrste: </label>
			<input class="unos" name="naziv" type="text" />
			<br/>
			<br/>
			<label class="natpisi" for="moderator"> Moderator: </label>
				<select class="unos" name="moderator" id="moderator">
					<?php
						while($row = mysql_fetch_array($rezultat2))
						{
							echo "<option value=\"".$row["korisnik_id"]."\"";
							echo ">".$row["korisnicko_ime"]."</option>";
						}
					?>
				</select>
				<br/>
			<input class="btnPrijava" type="submit" value="Unesi" name="unos" />
		</form>
		</div>
	</body>
</html>
<?php zatvaranjeVeze($veza); ?>