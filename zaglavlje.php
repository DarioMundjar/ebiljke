<div id="zaglavlje" class="zaglavlje">
	<h3> E-biljke </h3>
	<ul>
		<li>
		<a class="link" href="index.php"> Naslovna </a>
		</li>
		<li>
		<a class="link"  href="o_autoru.html"> Autor </a>
		</li>
		<?php if(!isset($_SESSION['id'])) { ?>
		<a  class="prijava_odj" href="prijava.php"> Prijava </a>
		<?php } else { ?>
		<a  class="prijava_odj" href="prijava.php?odjava=1">Odjava</a>
		<?php } ?>
	</ul>		
</div>