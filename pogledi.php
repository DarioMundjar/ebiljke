<?php 
if(isset($_SESSION['id'])){
	$upit = "SELECT * FROM zapisnik WHERE korisnik_id = '".$_SESSION['id']."' ";
	$rezultat = izvrsavanjeUpita($upit);
 	?>
		 <div class="zapisnici"> 
		 	<h4> Zapisnici</h4>
		 	<a  href="zapisnik.php"> Dodaj zapisnik </a>
		 	<br/>
		 	<br/>
		 	 <button onclick="prikaz()"> Postojeći zapisnici</button>
		  </div>
		 
		 	<br/>
	<div class="ispis_zapisnika" id="zapisnik">
		<table>
		<tr>
				<th> Naziv </th>
				<th> Datum kreiranja </th>
				<th> Opis </th>
				<th> Ažuriranje </th>
				<th> Pregled </th>
		 </tr>
	<?php 
		$i=0;
			while($row = mysql_fetch_array($rezultat)){
					echo "<tr>";
					echo "<td>".$row["naziv"]."</td>";
					echo "<td>".$row["datum_kreiranja"]."</td>";
					echo "<td>".$row["opis"]."</td>";
					echo "<td><a href=\"azur_zapisnika.php?id=".$row["zapisnik_id"]."\">Ažuriraj</a></td>";
					echo "<td> <a href=\"zapisi.php?id=".$row["zapisnik_id"]."\">Pregledaj</a>  </td>";
					echo "</tr>";	
					$i++;
				}
				if($i==0){
						echo "<tr>";
						echo "<td class=\"prazno\" colspan=\"5\">Ovdje još nema zapisnika! </td>";
						echo "</tr>";
						}
	?>
		</table>
		</div>
		 <?php 
		 	if($_SESSION['tip']==1){
		 		$upit2= "SELECT * FROM vrsta WHERE korisnik_id='".$_SESSION['id']."'";
		 		$vrste = izvrsavanjeUpita($upit2);
		 		if(isset($_POST['unesi'])){
		 			$biljka = $_POST['biljka'];
		 			$vrsta_id=$_POST['vrsta_id'];
		 		if(isset($biljka) && !empty($biljka)){
				$unos = "INSERT INTO biljka (`biljka_id`,`vrsta_id`,`naziv`) 
				VALUES (DEFAULT,'".$vrsta_id."', '".$biljka."')";
				izvrsavanjeUpita($unos);
				header("Location:index.php");
				exit();
			}
		}
?> 
		 <div class="unos_biljke">
		  	<h4>	Unos biljke </h4>
		  	<form action="<?php echo $_SERVER["PHP_SELF"];?>" method ="POST">
		  	<label for="biljka">Naziv biljke: </label>
		  	<input type="text" name="biljka" />
		  	<br/>
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
			<input class="btn" type="submit" name="unesi" value="Unesi biljku">
		  	</form>
		  
		  	<a href="popis_mod.php">Popis biljaka </a>
		 </div>
		  <?php 
		}
		 	if($_SESSION['tip']==0){
		 		$upit2= "SELECT * FROM vrsta";
		 		$vrste = izvrsavanjeUpita($upit2);
		 		if(isset($_POST['unesi'])){
		 			$biljka = $_POST['biljka'];
		 			$vrsta_id=$_POST['vrsta_id'];
		 		if(isset($biljka) && !empty($biljka)){
				$unos = "INSERT INTO biljka (`biljka_id`,`vrsta_id`,`naziv`) 
				VALUES (DEFAULT,'".$vrsta_id."', '".$biljka."')";
				izvrsavanjeUpita($unos);
				header("Location:index.php");
				exit();
			}
		}
?>
		 
		  <div class="unos_biljke">
		  	<h4>	Biljke </h4>
		  	<form action="<?php echo $_SERVER["PHP_SELF"];?>" method ="POST">
		  	<label for="biljka">Naziv biljke: </label>
		  	<input type="text" name="biljka" />
		  	<br/>
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
			<input class="btn" type="submit" name="unesi" value="Unesi biljku">
		  	</form>
		  	<a href="popis_mod.php">Pregled biljaka</a>
		  	<br/>
		  	<a href="vrste_bilj.php">Vrste biljaka</a>
		  	<br/>	
		  	<a href="nova_vrsta.php">Nova vrsta</a>
		  </div>
		  <div class="korisnici">
		  	<h4>Korisnici</h4>
		  	<a href="novikoris.php"> Novi korisnik </a>
		  	<br/>	
		  	 <a href="korisnici.php"> Postojeći korisnici </a>
		  </div>
	<?php }  }?>