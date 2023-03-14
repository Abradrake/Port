<!DOCTYPE html>
<html lang="sv-se">
<head>
	<meta charset="utf-8">
	<title>Create/Insert - &Ouml;vning CRUD</title>
	<link rel="stylesheet" type="text/css" href="crud_stil.css">
</head>
<body>
<?php



	// Om användaren klickat på formulärets spara-knapp
	if(isset($_POST['spara'])){

		// inkludera databaskoppling
		// Detta behövs bara om användare klickat på 'Spara'-knappen.
		require('databaskoppling.php');

		// Hämta in värden från formulär med hjälp av POST
		$Fnamn = $_POST['Fnamn'];
		$Enamn = $_POST['Enamn'];
		$Gatuadress = $_POST['Gatuadress'];
		$Postnummer = $_POST['Postnummer'];
		$Postadress = $_POST['Postadress'];
		$Telefon = $_POST['Telefon'];
		$Epost = $_POST['Epost'];

		// Skapa SQL-fråga (INSERT), använd variablerna som fyllts med det som användaren
		// skrivit in i formuläret.
		$sql = "INSERT INTO person (fnamn,enamn,gatuadress,postnummer,postadress,telefon,epost) VALUES ('$Fnamn','$Enamn','$Gatuadress','$Postnummer','$Postadress','$Telefon','$Epost')";

		// Kör frågan
		$mysqli->query($sql);

		// Skriv ut meddelande och länk tillbaka till startsidan
		echo "Personen är nu inlagd i databasen<br />";
		echo "<a href='read.php'>Tillbaka till listningssidan</a>";
	}

	// Om användare INTE klickat på spara-knapp
	else{
		// Här har jag valt att avsluta php eftersom jag tyckte det var enklare
		// att skriva formuläret i HTML (alltså inte med echo)
		?>
		<!--
		$_SERVER['PHP_SELF'] innebär  här "tillbaka till mig själv". Titta på hur ett litet
		php-block är infogat i HTML-koden på rad 52. Detta är användbart om ni bara behöver
		stoppa in en kort php-kodsnutt mitt i HTML-koden.
		-->

		<h3>L&auml;gg till ny person</h3>
		<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
			<table>

				<tr><td class="yell">Förnamn</td><td><input type="text" name="Fnamn"  /></td></tr>
				<tr><td class="yell">Efternamn</td><td><input type="text" name="Enamn"  /></td></tr>
				<tr><td class="yell">Gatuadress</td><td><input type="text" name="Gatuadress"  /></td></tr>
				<tr><td class="yell">Postnummer</td><td><input type="text" name="Postnummer"  /></td></tr>
				<tr><td class="yell">Postadress</td><td><input type="text" name="Postadress"  /></td></tr>
				<tr><td class="yell">Telefon</td><td><input type="text" name="Telefon"  /></td></tr>
				<tr><td class="yell">Epost</td><td><input type="text" name="Epost"  /></td></tr>
				<tr><td></td><td><input type="submit" name="spara" value="Spara" /></td></tr>
			</table>
		</form>
		<?php
		// Här startas php igen.
		// Det första (och enda i detta php-block) som händer är ett avslut pa 'else' som börjar på rad 42.
		}
		?>
	</body>
</html>
