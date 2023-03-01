<!DOCTYPE html>
<html lang="sv-se">
<head>
	<meta charset="utf-8">
	<title>Delete - &Ouml;vning CRUD</title>
	<link rel="stylesheet" type="text/css" href="crud_stil.css">
    
    
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script> 
$(document).ready(function(){
  $("#flip").click(function(){
    $("#panel").slideToggle("slow");
  });
});
</script>
    
    
</head>
<body>
    
    <img src="logo2.png" alt="Anton Abrahamsson" style="width:10%">
    <br>
    
   <h3>Ta bort serie</h3>
    
    <div id="flip">Klicka för mer information.</div>
<div id="panel">På denna sida tar du bort en serie. Om du inte vill göra det kan du backa ur. Du kommer inte kunna ångra det du gjort, om serien ska läggas in igen får du börja om från början.</div>
    
    
<?php
	//inkludera databaskoppling
	require('databaskoppling.php');

	// Om användaren klickat på formulärets ja-knapp
	if(isset($_POST['ja'])){

		// Hämta in PersonId från querystring
		$serieId = $_GET['serieId'];

		// SQL-fråga (DELETE), notera att det inte finns enkla
		// citat-tecken runt $PersonId i SQL-queryn eftersom det är ett numeriskt värde!
		$sql = "DELETE FROM serietidning WHERE serieid=$serieId";

		// Kör fråga
		$mysqli->query($sql);

		// Skriv ut meddelande och länk tillbaka till startsidan
		echo "Det har nu tagits bort från listan<br />";

		// Notera hur enkla och dubbla citat-tecken används här.
		echo '<a href="read.php">Återvänd</a>';
	}

	// Annars, om användaren klickat på förmulärets nej-knapp
	elseif(isset($_POST['nej'])){
		echo "Avbrott<br />";

		// Notera hur citat-tecken och \" (backslash + dubbelt citat-tecken) används på ett
		// annat sätt här, effekten är dock samma som för rad 30.
		echo "<a href=\"read.php\">Återvänd</a>";
	}

	// Annars, om användare INTE klickat på varken ja- eller nej-knappen:
	// Detta händer alltså när användaren kommer hit från read.php
	else{

		// Hämta in PersonId från querystring
		$serieId = $_GET['serieId'];

		// Definiera SQL
		$sql = "SELECT Titel, Manus FROM serietidning WHERE serieid=$serieId";

		// Kör frågan och spara i en vektor

		$result =$mysqli->query($sql);
		$myRow = $result->fetch_array();

		// Skriv ut ett meddelande som bekräftar om användaren vill ta bort personen
		
        
       
            
		echo "Vill du verkligen göra det här?<br />";

		// Skriv ut förnamnet och efternamnet på personen som kommer att tas bort
		// Detta med hjälp av variabeln $myRow (vektorn som resultatet av SQL-frågan sparats i)
		echo "<strong>" . $myRow['Titel'] . "</strong> ";
		echo "<strong>" . $myRow['Manus'] . "</strong>";

		// Avslutar PHP och skriver ut formuläret i HTML istället.
		?>

		<!-- Ett formulär med en ja- och nej knapp -->
		<!--  PersonId skickas med i querystring, detta görs i formulärets action-attribut -->
		<form action="delete.php?serieId=<?php echo $serieId?>" method="post">
			<input type="submit" name="nej" value="Nej" />
			<input type="submit" name="ja" value="Ja" />
		</form>

	<?php
	// Avslut på else
	}
	?>
	</body>
</html>
