<?php
error_reporting (E_ALL &~E_NOTICE);
session_start();
require_once('./connessione.php');
require_once("./stile.interno.php");

if (!isset($_SESSION['accessoPermesso'])) {
  header('Location: login.php');
}

           // costruzione parte dell'output con l'elenco e il costo degli articoli
$_SESSION['spesaFinora']=0;
$outputTable="<h3>Gentile cliente ";
$outputTable.= $_SESSION['userName'];

if (!$_SESSION['carrello']) {
   $outputTable.= " che ci fai qui con un carrello vuoto?\n";
} else {
    $_SESSION['accessoDaPaga']=1;
    $outputTable.=", stai per acquistare i seguenti articoli:</h3>\n";
    $outputTable.="<table>\n";

    foreach ($_SESSION['carrello'] as $k=>$v) {
      $aux='quantita' .$v;
      $outputTable.="<tr>\n<td>$v x" .$_SESSION[$aux] ."</td>\n";

       $sql1 = "SELECT *
              FROM $NOLsci_table_name
              WHERE tipoSci = \"$v\"
       ";

       $sql2 = "SELECT *
              FROM $NOLsnowboard_table_name
              WHERE tipoSnowboard = \"$v\"
       ";
       $sql3 = "SELECT *
              FROM $NOLscarponi_table_name
              WHERE tipoScarponi = \"$v\"
       ";

       $sql4 = "SELECT *
              FROM $NOLcaschi_table_name
              WHERE tipoCasco = \"$v\"
       ";

       if (!$resultQ = mysqli_query($mysqliConnection, $sql1)) {
             printf("Dammit! Can't execute sci select query.\n");
             exit();
       }
       $row1= mysqli_fetch_array($resultQ); // se e' uno sci

       if (!$resultQ = mysqli_query($mysqliConnection, $sql2)) {
             printf("Dammit! Can't execute snowboard select query.\n");
             exit();
       }
       $row2= mysqli_fetch_array($resultQ); // se e' uno snowboard

       if (!$resultQ = mysqli_query($mysqliConnection, $sql3)) {
             printf("Dammit! Can't execute scarponi select query.\n");
             exit();
       }
       $row3= mysqli_fetch_array($resultQ); // se e' uno scarpone

       if (!$resultQ = mysqli_query($mysqliConnection, $sql4)) {
             printf("Dammit! Can't execute caschi select query.\n");
             exit();
       }
       $row4= mysqli_fetch_array($resultQ); // se e' un casco

       $outputTable.="<td>(&euro; ";
       if (isset($row1)) {
         $aux='quantita' .$row1['tipoSci'];
         $prezz=$row1['costoSci']*$_SESSION[$aux];
       }
       if (isset($row2)) {
         $aux='quantita' .$row2['tipoSnowboard'];
         $prezz=$row2['costoSci']*$_SESSION[$aux];
       }
       if (isset($row3)) {
         $aux='quantita' .$row3['tipoScarponi'];
         $prezz=$row3['costoSci']*$_SESSION[$aux];
       }
       if (isset($row4)) {
         $aux='quantita' .$row4['tipoSci'];
         $prezz=$row4['costoSci']*$_SESSION[$aux];
       }
       $outputTable.= $prezz;
       $outputTable.=")</td>\n</tr>\n";

       $_SESSION['spesaFinora']+=$prezz;
    }

    $outputTable.="</table>\n<p>costo: {$_SESSION['spesaFinora']} &euro;</p>\n\n";
  }
            // fine outputTable

?>

<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <title>sessione con carrello della spesa: pagamento</title>
  <?php echo $stileInterno; ?>
</head>

<body>
 <table style="color: black; background: lime;" border="1">
  <tr>
    <td width="20%"><a href="pagina_iniziale.php" alt="aa">HOME PAGE</a></td>
    <td width="20%"><a href="mysql.sci.php" alt="aa">SCI</a></td>
    <td width="20%"><a href="mysql.snowboard.php" alt="aa">SNOWBOARD</a></td>
    <td width="20%"><a href="mysql.scarponi.php" alt="aa">SCARPONI</a></td>
    <td width="20%"><a href="mysql.caschi.php" alt="aa">CASCHI</a></td>
    <td width="20%"><a href="mysql.elimina.php" alt="aa">ELIMINA OGGETTI</a></td>
    <td width="20%"><a href="mysql.paga.php" alt="aa">PAGA</a></td>
    <td width="20%"><a href="mysql.logout.php" alt="aa">LOGOUT</a></td>
  </tr>
 </table>

<hr />

<h2>IMPORTO DA PAGARE</h2>

<?php
echo $outputTable;
?>

<form action="zona_pagamenti.php"  method="post" >
<p>SCEGLI LA DURATA DEL NOLEGGIO (1-30gg): <input type="number" name="durata" min="1" max="30"></p>
<p><input type="submit" name="invioPagamento" value="Procedi con il pagamento"/></p>
<p><input type="submit" name="invioPagamento" value="Annulla"/></p>
</form>


</body>
</html>
