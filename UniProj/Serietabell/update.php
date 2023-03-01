<!DOCTYPE html>
<html lang="sv-se">
	<head>
		<meta charset="utf-8">
		<title>Update - &Ouml;vning CRUD</title>
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
    
    
<?php
	// inkludera databaskoppling
	require('databaskoppling.php');


	// Om användaren klickat på formulärets spara-knapp
	if(isset($_POST['spara'])){

		// Hämta in värden från formulär som skickats med POST
		$serieId = $_POST['serieId'];
		$Titel = $_POST['Titel'];
		$Manus = $_POST['Manus'];
		$Teckning = $_POST['Teckning'];
		

		// SQL-fråga (UPDATE)
		// Notera att alla fält hämtas in och skrivs eftersom det är okänt *vilka* fält som har ändrats.
		$sql = "UPDATE serietidning SET Titel='$Titel', Manus='$Manus', Teckning='$Teckning' WHERE serieId=$serieId";

		// Kör frågan
				$mysqli->query($sql);

		// Skriv ut meddelande och länk tillbaka till startsidan
		echo "Nu har du rättat det<br />";
		echo "<a href='read.php'>Återvänd</a>";
	}

	// Om användare INTE klickat på spara-knapp
	else{

		// Hämta in serieId från querystring
		$serieId = $_GET['serieId'];

		// Definiera SQL
		$sql = "SELECT * FROM serietidning WHERE serieId=$serieId";

		// Kör frågan och spara i en array
		$result = $mysqli->query($sql);

		$myRow = $result->fetch_array()

		?>

		<!-- Ett formulär med samtliga fält från den aktuella personen -->
		<!-- I varje cell skrivs en kolumn ut, detta med hjälp av variabeln $myRow (arrayen som resultatet av SQL-frågan sparats i) -->
		<!-- Notera de korta php-blocken som finns i varje input-fält som skriver ut data som hämtats från tabellen -->
		<h3>&Auml;ndra </h3>
    
        <div id="flip">Klicka för mer information.</div>
<div id="panel">Du har kommit till redigeringsidan. Här kan du ändra information som du anser felaktig. SKriva bara in ny info och klicka spara. Om du har hamnat här av misstag och inte vill göra några ändringar behöver du bara backa, inget sparas om du inte klickar spara.</div>
		<form action="update.php" method="post">
			<table>
				<!--
				Notera att fältet för personId är 'readonly' eftersom detta är personens
				primärnyckel i tabellen och ska alltså inte gå att ändra. Här används värdet för att
				hålla reda på vilken person som ska uppdateras. Ett alternativt sätt att få med värdet
				utan att göra det 'ändringsbart' är att skriva det i ett 'gömt' fält (<input type="hidden">).
				Då blir det också osynligt.
				-->
				<tr><td class="yell">Id i databas</td><td><input type="text" name="serieId" value="<?php echo $myRow['serieid']; ?>" readonly /></td></tr>
				<tr><td class="yell">Titel</td><td><input type="text" name="Titel" value="<?php echo $myRow['Titel']; ?>" /></td></tr>
				<tr><td class="yell">Manus</td><td><input type="text" name="Manus" value="<?php echo $myRow['Manus']; ?>" /></td></tr>
				<tr><td class="yell">Teckning</td><td><input type="text" name="Teckning" value="<?php echo $myRow['Teckning']; ?>" /></td></tr>
				<tr><td></td><td><input type="submit" name="spara" value="Spara" /></td></tr>
			</table>
		</form>
		<?php
		}
		?>



	</body>
</html>
