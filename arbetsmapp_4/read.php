<!DOCTYPE html>
<html lang="sv-se">
	<head>
		<meta charset="utf-8" >
		<title>Read/Select - &Ouml;vning CRUD</title>
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
        
		<h3>Serierna</h3>
        
		<p>
			<!--Länk till en create-sida -->
			<a href="create.php">Lägg till serier</a>
		</p>
        
        <div id="flip">Klicka för mer information.</div>
<div id="panel">Detta är en databas för diverse serietidningar. Du kan se information om titel och vem som ligger bakom den. Om du anser att det bör läggas till en tidning, så kan du göra det. Om det står felaktig information om tidningen, så kan du ändra på det. Om du tycker att en tidning inte ska listas överhuvudtaget, då kan du ta bort den.</div>
        
		<table>
            <thead></thead>
            <tbody>
                
			<tr>
<?php
	//inkludera databaskoppling
	require('databaskoppling.php');


	// Konstruera en SQL-fråga som hämtar alla poster från tabellen 'person' i databasen
		$sql = "SELECT * FROM serietidning";

	//Om anslutningen lyckas så skall frågan köras mot databasen och lagras i $result.
	$result = $mysqli->query($sql);


		// For-loopen använder mysql-funktionen mysqli_num_fields för att räkna antal kolumner i tabellen.
		// För varje kolumn skrivs sedan en cell som innehåller kolumnnamnet ut.
		// Detta görs med mysqli-funktionen mysql_fetch_field_direct()

		// for ($i=0; $i < mysqli_num_fields($result); $i++) {
		// 	echo "<th>" . mysqli_fetch_field_direct($result, $i)->name ."</th>";
		// }


		// Om du vill visa innehållet i tabellen i en annan ordning (eller ett urval) än ovanstående kan du
		// själv bestämma genom att skriva ut th-cellerna med rubriker:
		// Om du använder detta, kom ihåg att kommentera bort ovanstående (rad 41-43), annars blir det två <th>-rader.

		// Skriver ut <th>-celler med rubriker.
		echo "<th>ID</th><th>Titel</th><th>Manus</th><th>Teckning</th>";


		// 2 tomma extraceller till ändra- och raderalänkarna och avslutning på raden med th-celler.
		echo "<th> </th><th> </th></tr>";

		// Start för tbody
		echo "\n<tbody>\n";

		// While-loopen skriver ut alla poster som hämtats från tabellen och som nu finns i $result.
		// Variablen $myRow är en temporär "mellanlagrings-variabel" som innhehåller data från en rad "i taget".

		// \n (Alltså "backslash + n" (newline) skapar en radbrytning i
		// utskriften/källan (men inte i HTML!), gör det lättare att läsa resultatet vid "view source")

		while($myRow = $result->fetch_array()) {
			echo "<tr>\n";
			echo "<td>" . $myRow['serieid'] . "</td>\n";
			echo "<td>" . $myRow['Titel'] . "</td>\n";
			echo "<td> " . $myRow['Manus'] . "</td>\n";
			echo "<td> " . $myRow['Teckning'] . "</td>\n";
			

			// Här följer de två cellerna för "Ändra" och "Radera"
			// Länken får en querystring som kommer att få med "PersonId" till sidan
			// update_person.php, respektive delete_person.php.

			// Titta extra noga på hur länkarna är uppbyggda, fundera över hur värden skickas,
			// vilka värden som skickas, och varför just dessa (personId = primärnyckelvärde i tabell!).
			// Prova att skicka flera värden i querystringen (avgränsa med "&", t.ex. ?varde1=xx&varde2=yy o.s.v.).

			// Titta också noga på hur dubbla och enkla citattecken används, försök reda ut varför det ser ut som det gör.

			// Hovra över dessa länkar (i webbläsaren) och titta på  hur querystringen förändras för varje person!
			echo '<td><a href="update.php?serieId=' . $myRow['serieid'] . '">Ändra</a></td>' . "\n";
			echo '<td><a href="delete.php?serieId=' . $myRow['serieid'] . '">Radera</a></td>' . "\n";
			echo "</tr>\n\n";
		}
	?>
                
               



	<!-- Avslutningstaggar for tbody, tabellen, body och html -->
				</tbody>
			</table>
		</body>
	</html>
