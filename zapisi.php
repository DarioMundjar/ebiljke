<?php
	include("baza.php");
	$veza=spajanjeNaBazu();
	session_start();

	if(!isset($_SESSION['id'])){
		header("Location:index.php");
		exit();
	}
	else {
 		if(isset($_GET['zid'])){
 		$id=$_GET['zid'];
 	} else {
 		$id=$_GET['id'];
 	}

	if(isset($_POST['filter'])){
		$datum1=$_POST['datum1'];
		$datum2=$_POST['datum2'];
		$greska="";
		if(!isset($datum1) || empty($datum1)){
			$greska.="Niste unijeli prvi datum!";
		}
		if(!isset($datum1) || empty($datum1)){
			$greska.="Niste unijeli drugi datum!";
		}
		if(empty($greska)){
			$upit1 = "SELECT * FROM zapis WHERE zapisnik_id = '".$id."' and datum>'".$datum1."' and datum <'".$datum2."' order by broj_parcele";
			$rezultat = izvrsavanjeUpita($upit1);
		}

	} else {
		$upit1 = "SELECT * FROM zapis WHERE zapisnik_id = '".$id."' order by broj_parcele";
	$rezultat = izvrsavanjeUpita($upit1);
	}

}
 	?>
<html>
	<head>
		<title> Zapisi </title>
		<meta charset="UTF-8" />
		<link href="css/autor.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="js/function.js"></script>
	</head> 
	<body>
	<?php include ("zaglavlje.php"); ?>
		  <div class="ispis_zapisa" id="zapisi">
		  	<h2> Zapisi </h2>
		  Filtriranje
		  <form action="<?php echo $_SERVER["PHP_SELF"]."?id=".$id; ?>" method="POST">
		  	<label class="natpisi" for="datum1"> Od: </label>
			<input type="text" name="datum1" placeholder="yyyy-mm-dd" size="10" maxlength="10" />
			<br/>
			<br/>
			<label class="natpisi" for="datum2"> Od: </label>
			<input type="text" name="datum2" placeholder="yyyy-mm-dd" size="10" maxlength="10"/>
			<br/>
			<br/>
			<input type="submit" name="filter" value="Filtriraj" />
		  </form>
		<table>
		<tr>
				<th> Biljka </th>
				<th> Datum </th>
				<th> Vrijeme </th>
				<th> Opis </th>
				<th> Broj parcele </th>
				<th> Broj biljke </th>
				<th> Ažuriranje </th>
		 </tr>
		<?php 
		$i=0;
			while($row = mysql_fetch_array($rezultat)){
					$upit2="SELECT naziv FROM biljka WHERE biljka_id = '".$row['biljka_id']."'";
					$rezultat2 =izvrsavanjeUpita($upit2);
					$biljka = mysql_fetch_row($rezultat2);
					echo "<tr>";
					echo "<td>".$biljka[0]."</td>";
					echo "<td>".$row["datum"]."</td>";
					echo "<td>".$row["vrijeme"]."</td>";
					echo "<td>".$row["opis"]."</td>";
					echo "<td>".$row["broj_parcele"]."</td>";
					echo "<td>".$row["broj_biljke"]."</td>";
					echo "<td><a href=\"azur_zapisa.php?id=".$row["zapis_id"]."&zapis=".$id."\">Ažuriraj</a></td>";
					echo "</tr>";	
					
					$i++;
				}
		if($i==0){
			echo "<tr>";
						echo "<td class=\"prazno\" colspan=\"7\">U ovom zapisniku još nema zapisa </td>";
						echo "</tr>";
		}
		zatvaranjeVeze($veza);
		?>
		</table>
	
		</div>
		<div class="knjiga">	
		<a href="novizapis.php?id=<?php echo $id; ?>"> <img src="img/booklet.png" /> <br/> <p> Dodaj zapis </p> </a>	
		</div>
	</body>
	</html>	
