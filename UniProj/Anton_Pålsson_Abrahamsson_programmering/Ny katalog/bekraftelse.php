<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title></title>
</head>
<body>
<header>
       <?php include 'sitehead.php';?>
       <a href="sitehead.php">sidhuvud</a></header>
  <?php
// Hämta formulärdata från formuläret som skickar data till denna sida

//Skapa en variabel
$epost=$_POST['epost1'];
    $namn=$_POST['namn'];
    $age=$_POST['age'];
//Skriv ut ett meddelande på webbsidan.
echo "<h1>Du angav epostadressen $epost - välkommen.</h1>";
    echo "<h1>Tack $namn - Tack så hemskt mycket.</h1>";
    echo "<h1>Du är $age - år gammal.</h1>";
  ?>
    <footer>
        <?php include 'footer.php';?>
 <div><a href="footer.php">sidfot</a></div>
    </footer>
</body>
</html>
