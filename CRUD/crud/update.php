<!DOCTYPE html>
<html lang="sv-se">
	<head>
		<meta charset="utf-8">
		<title>Update - &Ouml;vning CRUD</title>
		<link rel="stylesheet" type="text/css" href="crud_stil.css">
	</head>
<body>
<?php
	// inkludera databaskoppling
	require('databaskoppling.php');


	// Om användaren klickat på formulärets spara-knapp
	if(isset($_POST['spara'])){

		// Hämta in värden från formulär som skickats med POST
		$PersonId = $_POST['personId'];
		$Fnamn = $_POST['fnamn'];
		$Enamn = $_POST['enamn'];
		$Gatuadress = $_POST['gatuadress'];
		$Postnummer = $_POST['postnummer'];
		$Postadress = $_POST['postadress'];
		$Telefon = $_POST['telefon'];
		$Epost = $_POST['epost'];

		// SQL-fråga (UPDATE)
		// Notera att alla fält hämtas in och skrivs eftersom det är okänt *vilka* fält som har ändrats.
		$sql = "UPDATE person SET fnamn='$Fnamn', enamn='$Enamn', gatuadress='$Gatuadress', postnummer='$Postnummer', postadress='$Postadress',
		telefon='$Telefon', epost='$Epost' WHERE personId=$PersonId";

		// Kör frågan
				$mysqli->query($sql);

		// Skriv ut meddelande och länk tillbaka till startsidan
		echo "Personen är nu ändrad<br />";
		echo "<a href='read.php'>Tillbaka till listningssidan</a>";
	}

	// Om användare INTE klickat på spara-knapp
	else{

		// Hämta in PersonId från querystring
		$PersonId = $_GET['personId'];

		// Definiera SQL
		$sql = "SELECT * FROM person WHERE personId=$PersonId";

		// Kör frågan och spara i en array
		$result = $mysqli->query($sql);

		$myRow = $result->fetch_array()

		?>

		<!-- Ett formulär med samtliga fält från den aktuella personen -->
		<!-- I varje cell skrivs en kolumn ut, detta med hjälp av variabeln $myRow (arrayen som resultatet av SQL-frågan sparats i) -->
		<!-- Notera de korta php-blocken som finns i varje input-fält som skriver ut data som hämtats från tabellen -->
		<h3>&Auml;ndra personuppgifter</h3>
		<form action="update.php" method="post">
			<table>
				<!--
				Notera att fältet för personId är 'readonly' eftersom detta är personens
				primärnyckel i tabellen och ska alltså inte gå att ändra. Här används värdet för att
				hålla reda på vilken person som ska uppdateras. Ett alternativt sätt att få med värdet
				utan att göra det 'ändringsbart' är att skriva det i ett 'gömt' fält (<input type="hidden">).
				Då blir det också osynligt.
				-->
				<tr><td class="yell">Id i databas</td><td><input type="text" name="personId" value="<?php echo $myRow['personid']; ?>" readonly /></td></tr>
				<tr><td class="yell">Förnamn</td><td><input type="text" name="fnamn" value="<?php echo $myRow['fnamn']; ?>" /></td></tr>
				<tr><td class="yell">Efternamn</td><td><input type="text" name="enamn" value="<?php echo $myRow['enamn']; ?>" /></td></tr>
				<tr><td class="yell">Gatuadress</td><td><input type="text" name="gatuadress" value="<?php echo $myRow['gatuadress']; ?>" /></td></tr>
				<tr><td class="yell">Postnummer</td><td><input type="text" name="postnummer" value="<?php echo $myRow['postnummer']; ?>" /></td></tr>
				<tr><td class="yell">Postadress</td><td><input type="text" name="postadress" value="<?php echo $myRow['postadress']; ?>" /></td></tr>
				<tr><td class="yell">Telefon</td><td><input type="text" name="telefon" value="<?php echo $myRow['telefon']; ?>" /></td></tr>
				<tr><td class="yell">Epost</td><td><input type="text" name="epost" value="<?php echo $myRow['epost'] ?>" /></td></tr>
				<tr><td></td><td><input type="submit" name="spara" value="Spara" /></td></tr>
			</table>
		</form>
		<?php
		}
		?>



	</body>
</html>
