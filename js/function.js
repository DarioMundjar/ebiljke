function prikaz (){
	document.getElementById("zapisnik").style.visibility = "visible";
	document.getElementById("vrste").style.visibility = "hidden";	

}
function prikaz2 (){
	document.getElementById("zapisnik").style.visibility = "hidden";
	document.getElementById("vrste").style.visibility = "hidden";
	document.getElementById("popis").style.visibility="visible";
}
function prikaz3 (){
		document.getElementById("pozdrav").style.visibility = "hidden";
}
function validacija1()
      { 
      	var provjera=true;
      	var greska="Niste popunili slijedeća obavezna polja:\n";
         if( document.zapisnik.naziv.value == "" )
         {
	        greska+="naziv zapisnika\n";
    		provjera = false;
         }       
         if (!provjera){ 
         	alert(greska);
         }
  			return provjera;
      }
function validacija2()
      { 
      	var provjera=true;
      	var greska="Niste popunili slijedeća obavezna polja:\n";
      
         if( document.zapisi.datum.value == "" )
         {
	        greska+="datum unosa\n";
    		provjera = false;
         }   
         if(document.zapisi.vrijeme.value == "" )
         {
	        greska+="vrijeme unosa\n";
    		provjera = false;
         } 
         if( document.zapisi.opis.value == "" )
         {
	        greska+="opis\n";
    		provjera = false;
         } 
         if( document.zapisi.parcela.value == "" )
         {
	        greska+="parcelu\n";
    		provjera = false;
         }     
         if (!provjera){ 
         	alert(greska);
         }
  			return provjera;
      }
function validacija3()
      { 
      	var provjera=true;
      	var greska="Niste popunili slijedeća obavezna polja:\n";
         if( document.korisnici.ime.value == "" )
         {
	        greska+="Ime\n";
    		provjera = false;
         }    
          if( document.korisnici.lozinka.value == "" )
         {
	        greska+="Prezime\n";
    		provjera = false;
         }    
          if( document.korisnici.tip.value == "" )
         {
	        greska+="Tip\n";
    		provjera = false;
         } 
         if (!provjera){ 
         	alert(greska);
         }
  			return provjera;
      }
function validacija4()
      { 
      	var provjera=true;
      	var greska="Niste popunili slijedeća obavezna polja:\n";
         if( document.vrsta.naziv.value == "" )
         {
	        greska+="Naziv\n";
    		  provjera = false;
         }    
          
         if (!provjera){ 
         	alert(greska);
         }
  			return provjera;
      }
function validacija5()
      { 
      	var provjera=true;
      	var greska="Niste unijeli:\n";
         if( document.prijava.ime.value == "" )
         {
	        greska+="Ime\n";
    		provjera = false;
         }    
         if( document.prijava.lozinka.value == "" )
         {
	        greska+="Lozinku\n";
    		provjera = false;
         } 
         if (!provjera){ 
         	alert(greska);
         }
  			return provjera;
      }
      function validacija6()
      { 
      	var provjera=true;
      	var greska="Niste popunili slijedeća obavezna polja:\n";
         if( document.kor_azur.tip.value == "" )
         {
	        greska+="Tip\n";
    		provjera = false;
         }    
          if( document.kor_azur.ime.value == "" )
         {
	        greska+="Ime\n";
    		provjera = false;
         }    
          if( document.kor_azur.prezime.value == "" )
         {
	        greska+="Prezime\n";
    		provjera = false;
         } 
         if( document.kor_azur.email.value == "" )
         {
	        greska+="Email\n";
    		provjera = false;
         } 
          if( document.kor_azur.slika.value == "" )
         {
	        greska+="Slika\n";
    		provjera = false;
         } 
         if (!provjera){ 
         	alert(greska);
         }
  			return provjera;
      }