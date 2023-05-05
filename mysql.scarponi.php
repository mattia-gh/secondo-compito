<?php
error_reporting (E_ALL &~E_NOTICE);
session_start();
require_once("./connessione.php");
require_once("./stile.interno.php");

if (!isset($_SESSION['accessoPermesso'])){
  header('Location: login.php');
}

$sql = "SELECT *
       FROM $NOLscarponi_table_name
";

// il risultato della query va in $resultQ
if (!$resultQ = mysqli_query($mysqliConnection, $sql)) {
    printf("Dammit! Can't execute scarponi select query.\n");
  exit();
 }

// costruzione elenco scarponi (checkbox): per ogni riga selezionata
// con nome comune "selection"
$elenco="";
while ($row = mysqli_fetch_array($resultQ))
  $elenco.="<tr><td><input type=\"checkbox\" name=\"selection[]\" value=\"{$row['tipoScarponi']}\" />{$row['tipoScarponi']}</td>\n
           <td style=\" text-align:center; \">{$row['descr']}</td>\n
           <td style=\" text-align:center; \">&euro; {$row['costoScarponi']}</td>\n
           <td style=\" text-align:center; \"><input type=\"number\" name=\"quantita{$row['tipoScarponi']}\" min=\"1\" max=\"10\"></td>\n</tr>\n";


$mysqliConnection->close();
?>

<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>sessione con carrello della spesa per scarponi</title>
<?php echo $stileInterno; ?>
</head>

<body>

<table cellpadding="5" cellspacing="3">
<tr>
<td width="1%" style="vertical-align: top; background-color: #ffffbf;">
    <table style="color: black;">
    <tr><td width="20%"><a href="pagina_iniziale.php" alt="aa">HOME PAGE</a><hr /></td></tr>
    <tr><td width="20%"><a href="mysql.sci.php" alt="aa">SCI</a><hr /></td></tr>
    <tr><td width="20%"><a href="mysql.snowboard.php" alt="aa">SNOWBOARD</a><hr /></td></tr>
    <tr><td width="20%"><a href="mysql.scarponi.php" alt="aa">SCARPONI</a><hr /></td></tr>
    <tr><td width="20%"><a href="mysql.caschi.php" alt="aa">CASCHI</a><hr /></td></tr>
    <tr><td width="20%"><a href="mysql.elimina.php" alt="aa">ELIMINA OGGETTI</a><hr /></td></tr>
    <tr><td width="20%"><a href="mysql.paga.php" alt="aa">PAGA</a><hr /></td></tr>
    <tr><td width="20%"><a href="mysql.logout.php" alt="aa">LOGOUT</a><hr /></td></tr>
    </table>
</td>

<td width="20%">
<h2>SCARPONI</h2>
<p><?php echo $_SESSION['userName']?>, scegli pure gli scarponi che vuoi:</p>

<form action="<?php $_SERVER['PHP_SELF']?>"  method="post" >

<table>
<tr>
 <td width="35%">
<p style="margin-bottom: 15%">
<input type="submit" name="invio" value="Aggiungi al carrello"/>
</p>
<p style="margin-top: 15%">
<input type="submit" name="azzeraAcquisti" value="svuota il carrello"/>
</p>
 </td>

 <td>
   <table border="1" cellpadding="5">
     <thead>
       <th>TIPO SCARPONI</th>
       <th>DESCRIZIONE</th>
       <th>PREZZO<br />(1g)</th>
       <th>QUANTITA'<br />(1-10)</th>
     </thead>
<?php echo $elenco;?>
</table>
 </td>

<tr>
</table>

</form>

<?php
if ((!isset($_SESSION['carrello']) && !$_POST) || isset($_POST['azzeraAcquisti'])) {
   if (isset($_SESSION['carrello'])) {
     foreach ($_SESSION['carrello'] as $k=>$v) {
       $aux='quantita'.$v;
       unset($_SESSION[$aux]);
     }
   }
   if(isset($_SESSION['durata'])) {
     unset($_SESSION['durata']);
   }
   $_SESSION['carrello']=array();
   echo "<p> - carrello vuoto - </p>";
} else {
   if (isset($_POST['selection'])) {
     //echo "<p>inserisco".$_POST['selection']."</p>";
     //$_SESSION['carrello'][] = $_POST['selection'];
     foreach ($_POST['selection'] as $k => $v) {
       $aux='quantita'.$v;
       $trovato=0;
       if(isset($_SESSION['carrello'])) {
         foreach ($_SESSION['carrello'] as $m => $n) {
           if ($v==$n) {
             $trovato=1;
           }
         }
       }
       if ($trovato==0) {
         $_SESSION['carrello'][] = $v;
       }
       if (isset($_SESSION[$aux])) {
         if(!empty($_POST[$aux])) {
           $_SESSION[$aux]+=$_POST[$aux];
         }
         else {
           $_SESSION[$aux]+=1;
         }
       }
       else {
         if(!empty($_POST[$aux])) {
           $_SESSION[$aux]=$_POST[$aux];
         }
         else {
           $_SESSION[$aux]=1;
         }
       }
     }
   }
   echo "<p>Contenuto del carrello:</p>";
   echo "<ul>";
   foreach ($_SESSION['carrello'] as $k=>$v) {
     $aux='quantita'.$v;
     if (isset($_SESSION[$aux]))
    echo "<li>[$k] $v" ." x" .$_SESSION[$aux] ."</li>";
  }
  echo "</ul>";
  //print_r($_SESSION);
  echo "<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
  <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />";
}
?>
</td>

</tr>
</table>

</body>
</html>
