<!DOCTYPE HTML>
<html>  
<body>
   <header>
       <?php include 'sitehead.php';?>
       <a href="sitehead.php">sidhuvud</a></header>
<br>
<?php echo "välkommen på " . $_SERVER['SERVER_NAME']; ?><br>
<script>
function kolla(){
  //Hämta värden från inmatningsformulär
  var epost1 = document.getElementById('epost1').value;
  var epost2 = document.getElementById('epost2').value;
    var namn = document.getElementById('namn').value;
  var age = document.getElementById('age').value;
  // Jämför epost1 och Epost2
  if(epost1!==epost2){
    alert("Dina epostadresser överensstämmer inte");
    return false;
  }
}
</script>
 <form action="bekraftelse.php" method="post" onsubmit="return kolla()">
    Epost: <input type="text" name="epost1" id="epost1">
    <br><br>
    Epost2: <input type="text" name="epost2" id="epost2">
    <br><br>
     Namn: <input type="text" name="namn" id="namn">
    <br><br>
    Ålder: <input type="text" name="age" id="age">
    <br><br>
     <input type="submit" name="skicka" id="skicka" value="Validera">
    </form>
    <footer>
        <?php include 'footer.php';?>
        <div>
            <a href="footer.php">sidfot</a>
        </div>

    </footer>
</body>
</html>