<?php


//Av Anton Pålsson Abrahamsson och Therese Thorgersen
// Det här är php-kod på "mottagarsidan"
// Formulärdata lagras i lokala variabler 
        
//För GET, "ord" är fältet och "sprak" är radioknappar.

$ord = $_GET["ord"];
$sprak = $_GET["sprak"];

//Följande är Arrayer innehållande ord i olika språk.

$svenska = array("blomma", "katt", "hund", "kräfta", "bord", "papper", "sko", "cigarett", "robot", "dator");
        
$engelska = array("flower", "cat", "dog", "crayfish", "table", "paper", "shoe", "cigarette", "robot", "computer");

$tyska = array("blume", "katze", "hund", "krebs", "tabelle", "papier", "schuh", "zigarette", "roboter", "computer");

$franska = array("fleur", "chat", "chien", "écrevisse", "table", "papier", "chausurre", "cigarette", "robot", "ordinateur");

$spanska = array("flor", "gato", "perro", "cangrejo", "mesa", "papeles", "zapato", "cigarillo", "robot", "computadora");

$italienska = array("fiore", "gatto", "cane", "cancro", "tavolo", "carta", "scarpa", "sigaretta", "robot", "computer");

//If sats för kontroll av ord inom array svenska.
            
if (in_array($ord, $svenska))

    //Loop för översättningsalternativ
    
foreach ($svenska as $value) {
    if ($value == $ord){ 
        
        
        echo "<br>";
        
        // Följande är if satser för olika språk.
        
      if ($sprak == "engelska") {$oversatt = array_search ($ord, $svenska);
        echo $engelska[$oversatt];} 
        
       
       if ($sprak == "tyska") {$oversatt = array_search ($ord, $svenska);
        echo $tyska[$oversatt];}
        
        if ($sprak == "franska") {$oversatt = array_search ($ord, $svenska);
        echo $franska[$oversatt];}
        
        if ($sprak == "spanska") {$oversatt = array_search ($ord, $svenska);
        echo $spanska[$oversatt];}
        
        if ($sprak == "italienska") {$oversatt = array_search ($ord, $svenska);
        echo $italienska[$oversatt];}
        

           
        echo "<br>";
        
    }
    
}

//Else sats för ord som inte finns i $svenska

else {echo "Finns inte";}
    
    
    








//echo "<br>";
    
// Om ordet hittas, skriv ut ordet från den engelska array

?> 