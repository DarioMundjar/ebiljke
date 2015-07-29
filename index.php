<?php
	
include_once ("baza.php");
$veza=spajanjeNaBazu();
session_start();
$upit = "SELECT * FROM vrsta";
$vrste = izvrsavanjeUpita($upit);
?>
<html>
	<head>
		<title> Naslovna </title>
		<meta charset="UTF-8" />
		<link href="css/autor.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="js/function.js"></script>
	</head> 
	<body> 
		<?PHP
		include_once("zaglavlje.php");
		?>
		<div class="body">
		<?php if(isset($_SESSION['id'])) { if(($_SESSION['tip']==0)) { ?>
		<div class="vidljivo2">
		<?php } else {?>
		<div class="vidljivo">
		<?php } } else {?>
		<div class="vidljivo">
		<?php } ?>
		<div class="prijavljen">
		<?php
		 if (!isset($_SESSION['id'])){
			echo "<div class=\"ime\">Neregistrirani korisnik </div>";
			} else {
				echo " <div class=\"ime\"> Prijavljeni ste kao: <strong>".$_SESSION['kor_ime']."</strong> </div>";
			}
			?>
		</div>	
			<br/>
			<div class="prema_vrsti">
		<h4> Pregled prema vrsti </h4>
		<form method="POST" 
				action="<?php echo $_SERVER["PHP_SELF"] ?>">	
			<label for="vrsta_id">Vrste biljaka: </label>
					<select name="vrsta_id" id="vrsta_id">
						<?php
							while($row = mysql_fetch_array($vrste))
							{
								echo "<option value=\"".$row["vrsta_id"]."\"";
								echo ">".$row["naziv"]."</option>";
							}
						?>
					</select>
					<br/>	
			<input class="btn" type="submit" name="vrste" value="Ispiši po vrsti">
		</form>
		</div>
		<br/>
		<?php include ("pogledi.php"); ?>
		</div>
		<div class="rezultati">
		<?php if(!isset($_SESSION['id'])) { ?>
		
		<?php } ?>
			<div class="vrste" id="vrste">
			<?PHP
				if (isset($_POST['vrste'])){
					$id_vrste = $_POST['vrsta_id'];
					$upit = "SELECT * FROM biljka WHERE vrsta_id = $id_vrste";
					$rezultat = izvrsavanjeUpita($upit);
					
					while($row = mysql_fetch_array($rezultat)){
						$naziv_biljke = $row['naziv'];
						echo "<li>". $naziv_biljke."</li><br/>";		
					}
				}
				zatvaranjeVeze($veza);
			 ?>	
			 </div>
		</div>
		</div>	
	</body>
</html>