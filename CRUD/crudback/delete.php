<!DOCTYPE html>
<html lang="sv-se">
<head>
	<meta charset="utf-8">
	<title>Delete - &Ouml;vning CRUD</title>
	<link rel="stylesheet" type="text/css" href="crud_stil.css">
</head>
<body>
<?php
	//inkludera databaskoppling
	require('databaskoppling.php');

	// Om användaren klickat på formulärets ja-knapp
	if(isset($_POST['ja'])){

		// Hämta in PersonId från querystring
		$PersonId = $_GET['personId'];

		// SQL-fråga (DELETE), notera att det inte finns enkla
		// citat-tecken runt $PersonId i SQL-queryn eftersom det är ett numeriskt värde!
		$sql = "DELETE FROM person WHERE Personid=$PersonId";

		// Kör fråga
		$mysqli->query($sql);

		// Skriv ut meddelande och länk tillbaka till startsidan
		echo "Personen är borttagen<br />";

		// Notera hur enkla och dubbla citat-tecken används här.
		echo '<a href="read.php">Tillbaka till listningssidan</a>';
	}

	// Annars, om användaren klickat på förmulärets nej-knapp
	elseif(isset($_POST['nej'])){
		echo "Åtgärden har avbrutits<br />";

		// Notera hur citat-tecken och \" (backslash + dubbelt citat-tecken) används på ett
		// annat sätt här, effekten är dock samma som för rad 30.
		echo "<a href=\"read.php\">Tillbaka till listningssidan</a>";
	}

	// Annars, om användare INTE klickat på varken ja- eller nej-knappen:
	// Detta händer alltså när användaren kommer hit från read.php
	else{

		// Hämta in PersonId från querystring
		$PersonId = $_GET['personId'];

		// Definiera SQL
		$sql = "SELECT fnamn, enamn FROM person WHERE personid=$PersonId";

		// Kör frågan och spara i en vektor

		$result =$mysqli->query($sql);
		$myRow = $result->fetch_array();

		// Skriv ut ett meddelande som bekräftar om användaren vill ta bort personen
		echo "<h3>Ta bort person</h3>";
		echo "Är du säker på att du vill ta bort denna person?<br />";

		// Skriv ut förnamnet och efternamnet på personen som kommer att tas bort
		// Detta med hjälp av variabeln $myRow (vektorn som resultatet av SQL-frågan sparats i)
		echo "<strong>" . $myRow['fnamn'] . "</strong> ";
		echo "<strong>" . $myRow['enamn'] . "</strong>";

		// Avslutar PHP och skriver ut formuläret i HTML istället.
		?>

		<!-- Ett formulär med en ja- och nej knapp -->
		<!--  PersonId skickas med i querystring, detta görs i formulärets action-attribut -->
		<form action="delete.php?personId=<?php echo $PersonId?>" method="post">
			<input type="submit" name="nej" value="Nej" />
			<input type="submit" name="ja" value="Ja" />
		</form>

	<?php
	// Avslut på else
	}
	?>
	</body>
</html>
