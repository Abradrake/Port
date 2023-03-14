<?php
// Här ska du lägga in anslutningsinformation för att kunna ansluta dig mot din databas:
// Ditt användarID, ditt lösenord och namnet på den databas du ska använda.

$mysqli = new mysqli('mariadb.sh.se', 'ditt användarID', 'ditt lösenord', 'namn på din databas');


// Kontrollerar teckentabell
if (!$mysqli->set_charset("utf8")) {
  echo "Fel vid inställning av teckentabell utf8: %s\n". $mysqli->error;
}

// Om anslutningen misslyckas, skriv ut felmeddelande.
if ($mysqli->connect_errno) {
  echo "Misslyckades att ansluta till MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

?>
