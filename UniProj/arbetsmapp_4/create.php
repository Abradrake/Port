<!DOCTYPE html>
<html lang="sv-se">
<head>
	<meta charset="utf-8">
	<title>Create/Insert - &Ouml;vning CRUD</title>
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
    
    
    
<?php



	// Om användaren klickat på formulärets spara-knapp
	if(isset($_POST['spara'])){

		// inkludera databaskoppling
		// Detta behövs bara om användare klickat på 'Spara'-knappen.
		require('databaskoppling.php');

		// Hämta in värden från formulär med hjälp av POST
		$Titel = $_POST['Titel'];
		$Manus = $_POST['Manus'];
		$Teckning = $_POST['Teckning'];

		// Skapa SQL-fråga (INSERT), använd variablerna som fyllts med det som användaren
		// skrivit in i formuläret.
		$sql = "INSERT INTO serietidning (Titel,Manus,Teckning) VALUES ('$Titel','$Manus','$Teckning')";

		// Kör frågan
		$mysqli->query($sql);

		// Skriv ut meddelande och länk tillbaka till startsidan
		echo "Serien har lagts till, tack för ditt tillägg.<br />";
		echo "<a href='read.php'>Återvänd</a>";
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

		<h3>L&auml;gg till en serie</h3>
    
     <div id="flip">Klicka för mer information.</div>
<div id="panel">Här kan du lägga till en ny serie. Om du inte vill göra det kan du bara backa. Om du gör fel kan du altid ändra eller radera det du har lagt till.</div>
    
		<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
			<table>

				<tr><td class="yell">Titel</td><td><input type="text" name="Titel"  /></td></tr>
				<tr><td class="yell">Manus</td><td><input type="text" name="Manus"  /></td></tr>
				<tr><td class="yell">Teckning</td><td><input type="text" name="Teckning"  /></td></tr>
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
